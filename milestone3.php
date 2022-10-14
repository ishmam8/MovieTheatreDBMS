<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  This file shows the very basics of how to execute PHP commands
  on Oracle.
  Specifically, it will drop a table, create a table, insert values
  update values, and then query for values
  IF YOU HAVE A TABLE CALLED "demoTable" IT WILL BE DESTROYED
  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the
  OCILogon below to be your ORACLE username and password -->

  <html>
    <head>
        <title>Group 31 Milestone 3</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <style>
        body {
            background-image: url('https://wallpapercave.com/wp/wp2578195.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        h2{
            color: #FAF9F6;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
        p {
            color: #FAF9F6;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
        form {
            color: #FAF9F6;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
        .button {
            transform: scale(1.5);
            background-color:#0a0a23;
            color: #fff;
            border:none;
            border-radius:10px;
            box-shadow: 0px 0px 2px 2px rgb(0,0,0);
            margin-left:20px;
            
        }
        table, th, td {
            border: 1px solid;
            color: #FAF9F6;
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
        }
    </style>
    <body>
        <section>
        <h2>Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="milestone3.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the 
action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input class='button' type="submit" value="Reset" name="reset"></p>
        </form>
        <hr />

        <h2>View all Tables</h2>
        <form method="GET" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="selectQueryRequest" name="selectQueryRequest">
            <input class='button' type="submit" value="View" name="selectSubmit"></p>
        </form>
        <hr />

        <h2>Insert Values into Customer Table</h2>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertCustomerQueryRequest" name="insertCustomerQueryRequest">
            Customer_ID: <input type="text" name="insCustomersID"> <br /><br />
            Customer_Name: <input type="text" name="insCustomerName"> <br /><br />
            Age: <input type="text" name="insAge"> <br /><br />
            <input class='button' type="submit" value="Insert" name="insertSubmit"></p>
        </form>
        <hr />

        <h2>Insert Values into Ticket Table</h2>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertTableQueryRequest" name="insertTableQueryRequest">
            Ticket_ID: <input type="text" name="insTicketID"> <br /><br />
            Customer_ID: <input type="text" name="insCustomerID"> <br /><br />
            Theater_Number: <input type="text" name="insTheaterNo"> <br /><br />
            Seat_Number: <input type="text" name="insSeatNo"> <br /><br />
            Start_Time: <input type="text" name="insStartTime"> <br /><br />
            Movie_Name: <input type="text" name="insMovieName"> <br /><br />
            Ticket_Price: <input type="text" name="insTicketPrice"> <br /><br />
            <input class='button' type="submit" value="Insert" name="insertSubmit"></p>
        </form>
        <hr />

        <h2>Insert Values into Theater Table</h2>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertTheaterQueryRequest" name="insertTheaterQueryRequest">
            Theater_Number: <input type="text" name="insTheaterNo"> <br /><br />
            <input class='button' type="submit" value="Insert" name="insertSubmit"></p>
        </form>
        <hr />

        <h2>Update Seat Number</h2>
        <p>If you enter in a wrong Ticket ID or the chosen seat is already occupied, the update statement will not do anything.</p>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
            Customer Ticket ID: <input type="text" name="custTicketID"> <br /><br />
            New Seat Number: <input type="text" name="newSeatNum"> <br /><br />
            <input class='button' type="submit" value="Update" name="updateSubmit"></p>
        </form>
        <hr />

        <h2>Select rows to view from Ticket Table</h2>
        <p>If you enter a Theater Number not in the table, will result with an error.</p>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="selectRowQueryRequest" name="selectRowQueryRequest">
            Theater Number: <input type="text" name="theaterNo"> <br /><br />
            <input class='button' type="submit" value="Select" name="selectTicketRowSubmit"></p>
        </form>
        <hr />

        <h2>Select attributes to view from Ticket Table</h2>
        <form method="GET" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="projectQueryRequest" name="projectQueryRequest">
            <input class='button' type="submit" value="Select" name="projectSubmit"></p>
        </form>
        <hr />

        <h2>View max age for every customer name from Customer Table</h2>
        <p>Note: Customer names are case sensitive.</p>
        <form method="GET" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="projectCustQueryRequest" name="projectCustQueryRequest">
            <input class='button' type="submit" value="Select" name="projectCustRequest"></p>
        </form>
        <hr />

        <h2>Find all the customers who watched the movie:</h2>
        <p>Note: Movie Name is case sensitive</p>
        <form method="POST" action="milestone3.php">
            <input type="hidden" id="joinQueryRequest" name="joinQueryRequest">
            Movie Name: <input type="text" name="MovieName"> <br /><br />
            <input class='button' type="submit" value="Select" name="selectTicketRowSubmit">
        </form>
        <hr/>

        <h2>Find names of Customers who have watched all Movies</h2>
        <form method="GET" action="milestone3.php">
            <input type="hidden" id= "movie_customers" name="movie_customers">
            <input class="button" type="submit" value="Select" name="performDivision">
        </form>
        <hr/>

        <h2>Count the Tuples in Ticket table</h2>
        <form method="GET" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <input class='button' type="submit" name="countTuples"></p>
        </form>
        <hr/>

        <h2>Delete Theater_Number from Ticket Table</h2>
        <p>Click to delete the rows corresponding to Theater Numbers</p>
        <form method="POST" action="milestone3.php"> <!--refresh page when submitted-->
            <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
            Theater_Number: <input type="text" name="insTheaterNo"> <br /><br />
            <input class='button' type="submit" value="Delete" name="deleteSubmit"></p>
        </form> 
        <hr />
        </section>

        <?php
        //this tells the system that it's no longer just parsing html; it's now parsing PHP

        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

        function debugAlertMessage($message) {
            global $show_debug_alert_messages;

            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }

        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
            //echo "<br>running ".$cmdstr."<br>";
            global $db_conn, $success;

            $statement = OCIParse($db_conn, $cmdstr);
            //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

            if (!$statement) {
                echo "<p>Cannot parse the following command: " . $cmdstr . "</p>";
                $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
                echo htmlentities($e['message']);
                $success = False;
            }

            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<p>Cannot execute the following command: " . $cmdstr . "</p>";
                $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                $success = False;
            }

            return $statement;
        }

        function executeBoundSQL($cmdstr, $list) {
            /* Sometimes the same statement will be executed several times with different values for the variables 
involved in the query.
        In this case you don't need to create the statement several times. Bound variables cause a statement to 
only be
        parsed once and you can reuse the statement. This is also very useful in protecting against SQL 
injection.
        See the sample code below for how this function is used */

            global $db_conn, $success;
            $statement = OCIParse($db_conn, $cmdstr);

            if (!$statement) {
                echo "<p>Cannot parse the following command: " . $cmdstr . "</p>";
                $e = OCI_Error($db_conn);
                echo htmlentities($e['message']);
                $success = False;
            }

            foreach ($list as $tuple) {
                foreach ($tuple as $bind => $val) {
                    //echo $val;
                    //echo "<p>".$bind."</p>";
                    OCIBindByName($statement, $bind, $val);
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
                }

                $r = OCIExecute($statement, OCI_DEFAULT);
                if (!$r) {
                    echo "<p>Cannot execute the following command: " . $cmdstr . "</p>";
                    $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
                    echo htmlentities($e['message']);
                    echo "<br>";
                    $success = False;
                }
            }
        }

        function printResult($ticket, $customer, $theater) { //prints results from a select statement
            echo "<p>Retrieved data from table ticket and customer:</p>";
            echo "<table>";
            echo "<tr> <th>TicketID</th> <th>CustomerID</th> <th>TheaterNo</th> 
<th>SeatNo</th><th>StartTime</th><th>MovieName</th><th>TicketPrice</th></tr>";

            while ($row1 = OCI_Fetch_Array($ticket, OCI_BOTH)) {
                echo "<tr>
                <td>". $row1["TICKET_ID"] ."</td>
                <td>". $row1["CUSTOMER_ID"] ."</td>
                <td>". $row1["THEATER_NUMBER"] ."</td>
                <td>". $row1["SEAT_NUMBER"] ."</td>
                <td>". $row1["START_TIME"] ."</td>
                <td>". $row1["MOVIE_NAME"] ."</td>
                <td>". $row1["TICKET_PRICE"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";

            echo "<table>";
            echo "<tr> <th>Customer_ID</th> <th>Customer_Name</th> <th>Age</th></tr>";

            while ($row2 = OCI_Fetch_Array($customer, OCI_BOTH)) {
                echo "<tr>
                <td>". $row2["CUSTOMER_ID"] ."</td>
                <td>". $row2["CUSTOMER_NAME"] ."</td>
                <td>". $row2["AGE"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";

            echo "</table>";

            echo "<table>";
            echo "<tr> <th>Theater</th></tr>";

            while ($row3 = OCI_Fetch_Array($theater, OCI_BOTH)) {
                echo "<tr>
                <td>". $row3["THEATER_NUMBER"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }

            echo "</table>";
        }

        function printAttributes($result) {
            echo "<p>Retrieved data from table ticket:</p>";
            echo "<table>";
            echo "<tr><th>TheaterNo</th> <th>SeatNo</th> <th>StartTime</th> <th>MovieName</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr>
                <td>". $row["THEATER_NUMBER"]."</td>
                <td>". $row["SEAT_NUMBER"] ."</td>
                <td>". $row["START_TIME"] ."</td>
                <td>". $row["MOVIE_NAME"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";
        }

        function printMovies($result) {
            echo "<p>Retrieved data from table ticket:</p>";
            echo "<table>";
            echo "<tr> <th>Customer Name</th> </tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr>
                <td>". $row["CUSTOMER_NAME"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";

        }

        function printCustAttributes ($result) {
            echo "<p>Retrieved data from Customer Table:</p>";
            echo "<table>";
            echo "<tr><th>Name</th> <th>Age</th></tr>";

            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr>
                <td>". $row["CUSTOMER_NAME"] ."</td>
                <td>". $row["AGE"] ."</td>
                </tr>"; //or just use "echo $row[0]"
            }
            echo "</table>";
        }

        function printTicketRow ($result) {
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            if ($row) { // only print if Theater Number exists in ticket table
                echo "<p>Retrieved data for Theater Number " . $row["THEATER_NUMBER"] .":</p>";
                echo "<table>";
                echo "<tr> <th>TicketID</th> <th>CustomerID</th> <th>TheaterNo</th><th>SeatNo</th><th>StartTime</th>
                            <th>MovieName</th><th>TicketPrice</th></tr>";

                do {
                    echo "<tr>
                    <td>". $row["TICKET_ID"] ."</td>
                    <td>". $row["CUSTOMER_ID"] ."</td>
                    <td>". $row["THEATER_NUMBER"] ."</td>
                    <td>". $row["SEAT_NUMBER"] ."</td>
                    <td>". $row["START_TIME"] ."</td>
                    <td>". $row["MOVIE_NAME"] ."</td>
                    <td>". $row["TICKET_PRICE"] ."</td> 
                    </tr>";
                } while ($row = OCI_Fetch_Array($result, OCI_BOTH));

                echo "</table>";
            }
            else {
                echo "<p>Error: Theater Number not found</p>";
            }
            
        }

        function printJoinTable ($result) {
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            if ($row) { // only print if Movie Name exists in ticket table
                echo "<p>Retrieved data for Movie " . $row["MOVIE_NAME"] .":</p>";
                echo "<table>";
                echo "<tr> <th>TicketID</th> <th>CustomerID</th> <th>TheaterNo</th><th>SeatNo</th><th>StartTime</th>
                            <th>MovieName</th><th>TicketPrice</th>
                            <th>CustomerName</th> <th>Age</th></tr>";

                do {
                    echo "<tr>
                    <td>". $row["TICKET_ID"] ."</td>
                    <td>". $row["CUSTOMER_ID"] ."</td>
                    <td>". $row["THEATER_NUMBER"] ."</td>
                    <td>". $row["SEAT_NUMBER"] ."</td>
                    <td>". $row["START_TIME"] ."</td>
                    <td>". $row["MOVIE_NAME"] ."</td>
                    <td>". $row["TICKET_PRICE"] ."</td>
                    <td>". $row["CUSTOMER_NAME"] ."</td>
                    <td>". $row["AGE"] ."</td>
                    </tr>";
                } while ($row = OCI_Fetch_Array($result, OCI_BOTH));

                echo "</table>";
            }
            else {
                echo "<p>Error: Theater Number not found</p>";
            }
        }

        function connectToDB() {
            global $db_conn;

            // Your username is ora_(CWL_ID) and the password is a(student number). For example,
            // ora_platypus is the username and a12345678 is the password.
            $db_conn = OCILogon("ora_kalebhui", "a22343800", "dbhost.students.cs.ubc.ca:1522/stu");

            if ($db_conn) {
                debugAlertMessage("Database is Connected");
                return true;
            } else {
                debugAlertMessage("Cannot connect to Database");
                $e = OCI_Error(); // For OCILogon errors pass no handle
                echo htmlentities($e['message']);
                return false;
            }
        }

        function disconnectFromDB() {
            global $db_conn;

            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }

        function handleUpdateRequest() {
            global $db_conn;

            $custTicketID = $_POST['custTicketID'];
            $new_SeatNum = $_POST['newSeatNum'];

            // change seat number of a certain seat to another seat number (will not only work if new seat is empty)
            executePlainSQL("UPDATE ticket SET Seat_Number='" . $new_SeatNum . "' WHERE Ticket_ID='" . $custTicketID. "'");
            OCICommit($db_conn);
        }

        function handleSelectRequest() {
            global $db_conn;

            // you need the wrap the old name and new name values with single quotations
            $customer = executePlainSQL("SELECT * FROM customer");
            $ticket = executePlainSQL("SELECT * FROM ticket");
            $theater = executePlainSQL("SELECT * FROM theater");
            

            printResult($ticket, $customer, $theater);
            OCICommit($db_conn);
        }

        function handleProjectRequest() {
            global $db_conn;

            $ticket = executePlainSQL("SELECT Theater_Number, Seat_Number, Start_Time, Movie_Name FROM ticket");
            printAttributes($ticket);
            OCICommit($db_conn);
        }

        function handleProjectCustRequest() {
            global $db_conn;

            $names = $names = executePlainSQL("SELECT Customer_Name,  MAX(Age) AS Age FROM customer GROUP BY Customer_Name");
            printCustAttributes($names);
            OCICommit($db_conn);
        }

        function handleSelectRowTicketRequest() {
            global $db_conn;

            $theaterNo = $_POST['theaterNo'];
            // you need the wrap the old name and new name values with single quotations
            $row = executePlainSQL("SELECT * FROM ticket WHERE Theater_Number='" . $theaterNo ."'");
            printTicketRow($row);
            OCICommit($db_conn);
        }

        function handleJoinRequest() {
            global $db_conn;

            $MovieName = $_POST['MovieName'];

            $row = executePlainSQL("SELECT * FROM customer,ticket WHERE ticket.Movie_Name ='" . $MovieName . "' 
                                    AND ticket.Customer_ID = customer.Customer_ID");
            printJoinTable($row);
            OCICommit($db_conn);
        }

        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE ticket");
            
    
            // Create new table
            executePlainSQL("DROP TABLE customer");
            executePlainSQL("CREATE TABLE customer (
                Customer_ID     char(100) PRIMARY KEY,
                Customer_Name   char(250),
                Age             integer
            )");

            executePlainSQL("DROP TABLE theater");
            executePlainSQL("CREATE TABLE theater (
                Theater_Number       char(100) PRIMARY KEY
            )");
            
            echo "<p> creating new tables </p>";
            executePlainSQL("CREATE TABLE ticket (
                Ticket_ID       char(100) PRIMARY KEY,
                Customer_ID     char(100), 
                Theater_Number  char(100),
                Seat_Number     integer,
                Start_Time      char(100),
                Movie_Name      char(100),
                Ticket_Price    char(100),
                FOREIGN KEY (Customer_ID) REFERENCES customer(Customer_ID),
                FOREIGN KEY (Theater_Number) REFERENCES theater(Theater_Number) on delete cascade
                
            )");
            

            OCICommit($db_conn);
        }

        function handleInsertTableRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insTicketID'],
                ":bind2" => $_POST['insCustomerID'],
                ":bind3" => $_POST['insTheaterNo'],
                ":bind4" => $_POST['insSeatNo'],
                ":bind5" => $_POST['insStartTime'],
                ":bind6" => $_POST['insMovieName'],
                ":bind7" => $_POST['insTicketPrice']
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into ticket values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6, :bind7)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertCustRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insCustomersID'],
                ":bind2" => $_POST['insCustomerName'],
                ":bind3" => $_POST['insAge']

            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into customer values (:bind1, :bind2, :bind3)", $alltuples);
            OCICommit($db_conn);
        }

        function handleInsertTheaterRequest() {
            global $db_conn;

            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insTheaterNo']
            
            );

            $alltuples = array (
                $tuple
            );

            executeBoundSQL("insert into theater values (:bind1)", $alltuples);
            OCICommit($db_conn);
        }

        function handleCountRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT Count(*) FROM ticket");

            if (($row = oci_fetch_row($result)) != false) {
                echo "<p> The number of tuples in Ticket Table: " . $row[0] . "</p>";
            }
        }

        function handleDivisionRequest() {
            global $db_conn;

            $result = executePlainSQL("SELECT c.Customer_Name
                                       FROM customer c
                                       WHERE NOT EXISTS ((SELECT t.Movie_Name
                                                         FROM ticket t)
                                                         MINUS
                                                         (SELECT t1.Movie_Name
                                                          FROM ticket t1
                                                          WHERE t1.Customer_ID = c.Customer_ID))");


            printMovies($result);
            OCICommit($db_conn);
        }


        function handleDeleteRequest() {
            global $db_conn;

            $theater_number = $_POST['insTheaterNo'];

            // you need the wrap the old name and new name values with single quotations
            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("DELETE FROM theater WHERE THEATER_NUMBER=". $theater_number ."");
            OCICommit($db_conn);

            $result = executePlainSQL("SELECT * FROM ticket");
            printResult($result);
            OCICommit($db_conn);
        }

        // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertTableQueryRequest', $_POST)) {
                    handleInsertTableRequest();
                } else if (array_key_exists('insertCustomerQueryRequest', $_POST)) {
                    handleInsertCustRequest();
                } else if (array_key_exists('insertTheaterQueryRequest', $_POST)) {
                    handleInsertTheaterRequest();
                } else if (array_key_exists('deleteQueryRequest', $_POST)) {
                    handleDeleteRequest();
                } else if (array_key_exists('selectRowQueryRequest', $_POST)) {
                    handleSelectRowTicketRequest();
                } else if (array_key_exists('joinQueryRequest', $_POST)) {
                    handleJoinRequest();
                }

                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('selectQueryRequest', $_GET)) {
                    handleSelectRequest();
                } else if (array_key_exists('projectQueryRequest', $_GET)) {
                    handleProjectRequest();
                } else if (array_key_exists('projectCustQueryRequest', $_GET)) {
                    handleProjectCustRequest();
                } else if(array_key_exists('movie_customers', $_GET)) {
                    handleDivisionRequest();
                }

                disconnectFromDB();
            }
        }

        if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || 
            isset($_POST['deleteSubmit']) || isset($_POST['selectTicketRowSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['selectQueryRequest']) || 
                    isset($_GET['projectQueryRequest']) || isset($_GET['projectCustRequest']) ||
                    isset($_GET['performDivision'])) {
            handleGETRequest();
        }
        ?>
    </body>
</html>
