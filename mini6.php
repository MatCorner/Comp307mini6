<!DOCTYPE html>
<html>

<head>
    <style>
        table{
            border-spacing: 0px;
            margin:0;
            padding:0;
            background-color:#EDF5E1;
            width:50%;
            border-collapse: collapse;
            height:30px;
        }
        
        .red-row {
            background-color: #8EE4AF;
        }

        th, td {
        border: 1px solid gray; 
}
    </style>
</head>

<body>
    <h1> CSV Records </h1>

    <?php
    $myfile = 'mini6.csv';

    // Check if the file doesn't exist
    if (!file_exists($myfile)) {
        $file = fopen($myfile, 'w');
        fclose($file);
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['books']) && isset($_POST['os'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $book = $_POST['books'];
            $os = $_POST['os'];

            // Prepare CSV data
            $data = "$fname,$lname,$email,$phone,$book,$os\n";

            // Append data to CSV file
            $append_file = fopen($myfile, 'a') or die("unable to open file!");
            fwrite($append_file, $data);
            fclose($append_file);
        } else {
            echo "not receiving value";
        }
    }
    ?>

    <table>
        <tr>
            <th>fname</th>
            <th>lname</th>
            <th>email</th>
            <th>phone</th>
            <th>book</th>
            <th>os</th>
        </tr>

        <?php
        $is_Red = true;
        //fgets while {……fgets}解决了feof多读一行的问题
        $read_file = fopen($myfile, 'r') or die("unable to open file!");
        $content = fgets($read_file);
        while (!feof($read_file)) {
            $is_Red = !$is_Red;
            
            $ary = explode(',', $content);
            if ($is_Red) {
                echo "<tr>";
            } else {
                echo '<tr class="red-row">';
            }
            for ($i = 0; $i < count($ary); $i++) {
                echo "<td>";
                echo trim($ary[$i]);
                echo "</td>";
            }
            echo "</tr>";
            $content = fgets($read_file);
        }

        fclose($read_file);
        ?>

    </table>
</body>

</html>
