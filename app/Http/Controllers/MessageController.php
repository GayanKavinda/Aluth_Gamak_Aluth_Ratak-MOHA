<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Conversation; // Import the Conversation model
use App\Models\Reply; // Import the Reply model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;


include_once app_path('Districts.php');

class MessageController extends Controller
{
    public function index()
    {
        // Check if the authenticated user is a super admin or admin
        if (auth()->user()->hasRole(['super-admin', 'admin'])) {
            // If super admin or admin, fetch all users
            $users = User::all();
        } else {
            // If not a super admin or admin, fetch messages received by or sent by the authenticated user
            $userId = auth()->id();
            $users = User::where('id', $userId)
                ->orWhereIn('id', function($query) use ($userId) {
                    $query->select('receiver_id')
                        ->from('messages')
                        ->where('sender_id', $userId);
                })
                ->get();
        }
        
        // Fetch all districts
        $districts = getAllDistricts();

        return view('messages.index', compact('users', 'districts'));
    }


    public function create(Request $request)
    {
        $selectedDistrict = $request->input('district', 'All Districts');
        $districts = getAllDistricts();
        $workplaces = [];
        if ($selectedDistrict !== 'All Districts') {
            $workplaces = User::where('district', $selectedDistrict)
                ->whereNotNull('workplace')
                ->distinct()
                ->pluck('workplace');
        }
        return view('messages.create', compact('districts', 'selectedDistrict', 'workplaces'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'district' => 'required',
            'workplace' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'body' => 'required',
        ]);

        // Find the user based on the provided email
        $user = User::where('email', $validatedData['email'])->first();

        // If user is not found, return an error message
        if (!$user) {
            return redirect()->back()->with('error', 'User with the provided email not found.');
        }

        // Create the message with correct sender, receiver, and user IDs
        $message = new Message();
        $message->user_id = $user->id; // Assign the user_id of the recipient
        $message->receiver_id = $user->id; // Receiver ID is the ID of the recipient
        $message->sender_id = auth()->id(); // Sender ID is the ID of the authenticated user
        $message->district = $validatedData['district'];
        $message->workplace = $validatedData['workplace'];
        $message->subject = $validatedData['subject']; // Assign the subject from the request
        $message->body = $validatedData['body'];
        $message->email = $validatedData['email'];
        $message->save();

        // Log the activity for message received by the recipient
        activity()->performedOn($message)
                ->causedBy(auth()->user())
                ->log("Message '{$message->subject}' received by {$user->name} ({$user->email})");

        // Redirect to a success page or display a success message
        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }


    public function show($id)
    {
        try {
            // Fetch messages for the selected user
            $userMessages = Message::where('receiver_id', $id)->get();

            // Return the user messages as JSON response
            return response()->json(['userMessages' => $userMessages]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching messages: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Failed to fetch messages. Please try again.'], 500);
        }
    }


    public function destroy(Message $message)
    {
        // Logic to delete a message
    }

    public function fetchWorkplaces(Request $request)
    {
        $selectedDistrict = $request->input('district');
        $workplaces = User::where('district', $selectedDistrict)
            ->whereNotNull('workplace')
            ->distinct()
            ->pluck('workplace');

        return response()->json(['workplaces' => $workplaces]);
    }

    public function fetchUserEmail(Request $request)
    {
        $selectedDistrict = $request->input('district');
        $selectedWorkplace = $request->input('workplace');
        
        $user = User::where('district', $selectedDistrict)
                    ->where('workplace', $selectedWorkplace)
                    ->first();

        $email = $user ? $user->email : null;

        return response()->json(['email' => $email]);
    }

    public function getUserMessages($userId)
    {
        try {
            // Fetch messages for the selected user
            $userMessages = Message::where('receiver_id', $userId)->get();

            // Check if messages were found
            if ($userMessages->isEmpty()) {
                return response()->json(['error' => 'No messages found for the user.'], 404);
            }

            // Return the user messages as JSON
            return response()->json(['userMessages' => $userMessages]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching messages: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Failed to fetch messages. Please try again.'], 500);
        }
    }


    public function fetchMessages(Request $request, $userId)
    {
        try {
            $selectedDistrict = $request->input('district');
            $selectedWorkplace = $request->input('workplace');

            // Fetch messages based on the selected district and workplace
            $userMessages = Message::where('receiver_id', $userId)
                ->where('district', $selectedDistrict)
                ->where('workplace', $selectedWorkplace)
                ->get();

            // Return the user messages as JSON response
            return response()->json(['userMessages' => $userMessages]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching messages: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'Failed to fetch messages. Please try again.'], 500);
        }
    }

    public function searchMessages(Request $request)
    {
        // Validate search input
        $request->validate([
            'workplace' => 'required|string',
        ]);

        // Fetch messages based on the searched workplace
        $workplace = $request->input('workplace');
        $messages = Message::where('workplace', 'LIKE', '%' . $workplace . '%')->get();

        // Return the filtered messages
        return response()->json(['messages' => $messages]);
    }

    public function __construct()
    {
        $this->middleware('admin')->only('create');
    }

    // Method to send a message to all districts
    public function sendToAll(Request $request)
    {
        // Validate the request data
        $request->validate([
            'subjectAll' => 'required',
            'bodyAll' => 'required',
        ]);

        // Get all districts
        $districts = getAllDistricts(); // Call the function directly

        // Get the authenticated user (sender)
        $sender = Auth::user();

        // Iterate through each district and send the message to registered users in that district
        foreach ($districts as $district) {
            // Get all registered users in the current district
            $usersInDistrict = User::where('district', $district)->get();

            // Send message to each user in the current district
            foreach ($usersInDistrict as $user) {
                $message = new Message();
                $message->user_id = $user->id;
                $message->receiver_id = $user->id; // Set receiver_id to the current user's ID
                $message->sender_id = $sender->id; // Set sender_id to the authenticated user's ID
                $message->district = $district;
                $message->workplace = $user->workplace; // Set workplace to the user's workplace
                $message->subject = $request->input('subjectAll');
                $message->body = $request->input('bodyAll');
                $message->email = $user->email; // Set email to the user's email
                // Additional fields like workplace can be set here if available
                $message->save();

                // Log the activity for message received by the user
                activity()
                    ->performedOn($message)
                    ->causedBy($sender)
                    ->log("Message received by {$user->name} ({$user->email}) from super admin");

                // You can also log this activity on the recipient user if needed
                // activity()
                //     ->performedOn($user)
                //     ->causedBy($sender)
                //     ->log("Message received from super admin");
            }
        }

        // Redirect back or to a specific route after sending messages
        return redirect()->back()->with('success', 'Messages sent to registered users in all districts successfully.');
    }


    public function deleteAllMessages($userId)
    {
        try {
            // Get the user whose messages are being deleted
            $deletedUser = User::find($userId);

            if (!$deletedUser) {
                Log::error("User with ID {$userId} not found.");
                return response()->json(['error' => 'User not found.'], 404);
            }

            // Get all messages for the specified user
            $messages = Message::where('receiver_id', $userId)->get();

            // Log the activity for each deleted message
            $currentUser = Auth::user();
            foreach ($messages as $message) {
                activity()
                    ->performedOn($message)
                    ->causedBy($currentUser)
                    ->log("Message '{$message->subject}' for {$deletedUser->name} ({$deletedUser->email}) deleted.");

                // Delete the message
                $message->delete();
            }

            return response()->json(['success' => 'All messages deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting messages: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to delete messages. Please try again.'], 500);
        }
    }


    public function deleteAllUsersMessages()
    {
        try {
            // Check if the authenticated user is a super-admin
            if (auth()->user()->hasRole('super-admin')) {
                // Get the count of messages before deleting
                $messageCount = Message::count();

                // Delete all messages for all users
                Message::truncate();

            
                // Log the activity for deleting all users' messages
                $messageModel = new Message(); // Create a new instance of the Message model
                activity()->performedOn($messageModel) // Pass the instance to performedOn()
                    ->causedBy(auth()->user())
                    ->withProperties(['count' => $messageCount, 'subject' => 'All users\' messages']) // Include subject
                    ->log("All users' messages deleted");


                return response()->json(['success' => 'All users\' messages deleted successfully.']);
            } else {
                // Return an error response if the user is not authorized
                return response()->json(['error' => 'Unauthorized. Only super-admins can perform this action.'], 403);
            }
        } catch (\Exception $e) {
            // Log the error if an exception occurs
            Log::error('Error deleting users\' messages: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to delete users\' messages. Please try again.'], 500);
        }
    }
}

