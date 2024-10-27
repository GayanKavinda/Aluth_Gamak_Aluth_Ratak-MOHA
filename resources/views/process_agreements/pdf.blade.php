<!DOCTYPE html>
<html>
<head>
    <title>Process Agreements</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Process Agreements</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>District</th>
                <th>Field</th>
                <th>Task</th>
                <th>Performance Indicator</th>
                <th>Contracted Target</th>
                <th>1st Quarter</th>
                <th>2nd Quarter</th>
                <th>3rd Quarter</th>
                <th>4th Quarter</th>
                <th>Total</th>
                <th>Percentage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processAgreements as $processAgreement)
                <tr>
                    <td>{{ $processAgreement->id }}</td>
                    <td>{{ $processAgreement->user->name }}</td>
                    <td>{{ $processAgreement->user->email }}</td>
                    <td>{{ $processAgreement->user->district }}</td>
                    <td>{{ $processAgreement->field }}</td>
                    <td>{{ $processAgreement->task }}</td>
                    <td>{{ $processAgreement->performance_indicator }}</td>
                    <td>{{ $processAgreement->contracted_target }}</td>
                    <td>{{ $processAgreement->first_quarter }}</td>
                    <td>{{ $processAgreement->second_quarter }}</td>
                    <td>{{ $processAgreement->third_quarter }}</td>
                    <td>{{ $processAgreement->fourth_quarter }}</td>
                    <td>{{ $processAgreement->total }}</td>
                    <td>{{ $processAgreement->percentage }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
