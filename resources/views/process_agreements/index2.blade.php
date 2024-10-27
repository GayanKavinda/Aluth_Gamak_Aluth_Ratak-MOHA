@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
     /* Custom hover color for table */
     .table-primary tbody tr:hover td {
        background-color: #fff; /* Hover color */
    }

    /* Custom style for header row */
    .table-primary thead th {
        background-color: #8b7cbf; /* Purple color */
        color: #fff; /* White text color */
    }

    /* Custom style for table cells */
    .table-primary tbody td {
        background-color: #f8f9fa; /* Light gray background */
    }

    /* Adjusting padding for better cell alignment */
    .table-primary td, .table-primary th {
        padding: 0.75rem;
    }
</style>
</head>
<body>

<div class="container mt-3">
        <a href="{{'roles'}}" class="btn btn-primary mx-2">Roles</a>
        <a href="{{'permissions'}}" class="btn btn-info mx-2">Permissions</a>
        <a href="{{'users'}}" class="btn btn-success mx-2">Users</a>
        <a href="{{'index'}}" class="btn btn-danger mx-2">Index</a>
        <a href="{{'create'}}" class="btn btn-primary mx-2">Form</a>
</div>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="container">

    <table class="table table-primary table-bordered border-primary">
        <tr>
            <th>Field</th>
            <th>Tasks expected to be performed during the year</th>
            <th>Performance index</th>
            <th>Contracted target</th>
            <th>1st quarter</th>
            <th>2nd quarter</th>
            <th>3rd quarter</th>
            <th>4th quarter</th>
            <th>Total</th>
            <th>Percentage (%)</th>
        </tr>


        <!-- Economic Part -->
        <tr>
            <td rowspan="2">1. Economic</td>
            <td>1.1 Creation of small scale or medium scale entrepreneurs</td>
            <td>Number of Entrepreneurs</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>1.2 Creation of industrial or agricultural export products</td>
            <td>Number of Projects</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Social Part -->
        <tr>
            <td rowspan="3">2. Social</td>
            <td>2.1 Getting children who do not go to school to school</td>
            <td>Migration of school-going children</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>2.2 Liberating and socializing those who are victims of drugs</td>
            <td rowspan="2">Drug-free and social transition</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>2.3 Liberating and socializing families selling illegal drugs</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Poverty Alleviation -->
        <tr>
            <td rowspan="1">3. Poverty Alleviation</td>
            <td>3.1 Economically sustainable upliftment of families suffering from economic difficulties</td>
            <td>Economically empowered family migration</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Health and nutrition -->
        <tr>
            <td rowspan="2">4. Health and nutrition</td>
            <td>4.1 Maintaining the nutritional status of low-income pregnant mothers with nutritional needs until delivery.</td>
            <td>Pregnant mothers migration</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>4.2 Increasing the nutritional level of low-income children with nutritional needs.</td>
            <td>Child migration facilitating improved nutrition</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        

        <!-- Agricultural -->
        <tr>
            <td rowspan="1">5. Agricultural</td>
            <td>5.1 Sustainable garden design</td>
            <td>Number of Gurdens</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Environment -->
        <tr>
            <td rowspan="1">6. Environment</td>
            <td>6.1 Carrying out planting projects that contribute to environmental conservation/ including urban forestry</td>
            <td>Number of projects</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Govenment Revenue -->
        <tr>
            <td rowspan="3">7. Government Revenue</td>
            <td>7.1 Increase in government revenue</td>
            <td></td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>7.2 Increasing state revenue through district coffee plantation</td>
            <td></td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>7.3 Income from tourist bungalows run by the concerned District Secretariat</td>
            <td></td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Public expenditure -->
        <tr>
            <td rowspan="1">8. Public expenditure</td>
            <td>8.1 Reducing recurring costs</td>
            <td></td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Projects -->
        <tr>
            <td rowspan="4">9. Projects</td>
            <td>9.1 Conducting community care programs for the needy people of the respective district.</td>
            <td>Number of Projects</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>9.2 Household management to create an economically empowered, prosperous family unit in the district.</td>
            <td>Number of Families</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>9.3 Making rural schools a taxi that secures the future of children.</td>
            <td>Number of Schools</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>
        <tr>
            <td>9.4 Implementation of mobile services involving government employees to solve the problems of rural people.</td>
            <td>Number of Programes</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>


        <!-- Awarding of NVQ Certificates under Joint Participation Programme -->
        <tr>
            <td rowspan="1">10. Awarding of NVQ Certificates under Joint Participation Programme.</td>
            <td>10.1 Provision of NVQ certificates.</td>
            <td>Number of trainees issuing certificates</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
            <td>x</td>
        </tr>



        <!-- <tr>
            <td rowspan="3">Lary</td>
            <td>Advanced Web</td>
            <td>80</td>
        </tr>
        <tr>
            <td>Operating System</td>
            <td>75</td>
        </tr>
        <tr>
            <td colspan="2">Total Average: 77.5</td>
        </tr> -->

    </table>

</div>
</body>
</html>