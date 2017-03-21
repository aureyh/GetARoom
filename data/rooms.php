<?php
  //This file contains the DDL for the the room table

  include("addRoom.php"); #Contains room adding function

  //Change connection information as needed
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mainDB";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "DROP TABLE ROOMS";
  if ($conn->query($sql) === TRUE) {
      echo "Dank Drop";
  } else {
      echo "Error dropping table: " . $conn->error;
  }


  $sql = "CREATE TABLE ROOMS(
  name VARCHAR(20) PRIMARY KEY,
  capacity INT(3),
  features VARCHAR(100),
  type VARCHAR(15)
  )";

  if ($conn->query($sql) === TRUE) {
    echo "Table ROOMS created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  addRoom('ART 102', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 103', 121, 'Projector - Overhead transparency, A/V System, Whiteboard, Microphone', 'Classroom');
  addRoom('ART 104', 46, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 106', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 108', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 110', 46, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 112', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 114', 100, 'Tables, Projector - Overhead transparency, DVD/Blu-ray, A/V System, Microphone', 'Classroom');
  addRoom('ART 202', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 203', 24, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 204', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 206', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 208', 42, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 210', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 214', 93, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone, DVD/Blu-ray', 'Classroom');
  addRoom('ART 215', 41, 'PC', 'Computer Lab');
  addRoom('ART 218', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('ART 219', 45, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard, DVD/Blu-ray, VCR', 'Classroom');
  addRoom('ART 281', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 365', 35, 'Tables - Moveable', 'Classroom');
  addRoom('ART 366', 200, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom');
  addRoom('ART 374', 33, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 376', 102, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom');
  addRoom('ART 382', 18, 'Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('ART 386', 95, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom');
  addRoom('ASC 130', 120, 'Tables', 'Classroom'); #Manual Check
  addRoom('ASC 140', 302, 'Tables', 'Classroom');  #Manual Check
  addRoom('ASC 165', 31, 'PC, A/V System, Projector', 'Computer Lab');
  addRoom('EME 0050', 180, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone, DVD/Blu-ray', 'Classroom');
  addRoom('EME 1101', 80, 'Tables,  Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 1121', 72, 'Tables,  Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 1151', 50, 'Tables,  Projector - Overhead transparency, A/V System, Microphone', 'Classroom');
  addRoom('EME 1153', 48, 'Tables, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 1202', 60, 'Tables - Moveable, Whiteboard', 'Classroom');
  addRoom('EME 2111', 60, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 2141', 70, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 2181', 50, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('EME 2202', 30, 'Restricted', 'Classroom'); #Manual Check
  addRoom('EME 2205', 27, 'PC', 'Computer Lab');
  addRoom('FIP 121', 70, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Microphone, DVD/Blu-ray', 'Classroom');
  addRoom('FIP 124', 32, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('FIP 129', 21, 'PC', 'Computer Lab');
  addRoom('FIP 133', 21, 'PC', 'Computer Lab');
  addRoom('FIP 138', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('FIP 139', 34, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('FIP 140', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('FIP 204', 300, 'Tables', 'Classroom'); #Manual check
  addRoom('FIP 239', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('FIP 247', 20, 'Projector - Overhead transparency, A/V System, Whiteboard, Restricted', 'Labratory'); #Manual Check
  addRoom('FIP 250', 32, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('LIB 303', 25, 'Tables - Moveable', 'Classroom');
  addRoom('LIB L302', 25, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('LIB L304', 45, 'Tables - Moveable', 'Classroom');
  addRoom('LIB L305', 100, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom');
  addRoom('LIB L306', 45, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom');
  addRoom('LIB L312', 120, 'Tables, Projector - Overhead transparency, A/V System, Microphone', 'Classroom');
  addRoom('LIB L317', 130, 'Tables, Projector - Overhead transparency, A/V System, Microphone', 'Classroom');
  addRoom('SCI 216', 21, 'PC', 'Computer Lab');
  addRoom('SCI 218', 30, 'MAC', 'Computer Lab');
  addRoom('SCI 234', 31, 'PC', 'Computer Lab');
  addRoom('SCI 236', 31, 'Tables - Moveable, Projector, A/V System, Whiteboard', 'Classroom');
  addRoom('SCI 247', 80, 'Tables, Projector - Overhead transparency, A/V System, Whiteboard, Chalkboard', 'Classroom');
  addRoom('SCI 333', 109, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom');
  addRoom('SCI 337', 104, 'Tables, Projector - Overhead transparency, A/V System, Whiteboard, Document Camera, Microphone', 'Classroom');
  addRoom('SCI 396', 40, 'Tables - Moveable, Projector, A/V System', 'Classroom');
 ?>
