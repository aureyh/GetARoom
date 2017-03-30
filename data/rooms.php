<?php

//DEPRICATED_FILE_HAS ERRORS
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

  /*$sql = "DROP TABLE ROOMS";
  if ($conn->query($sql) === TRUE) {
      echo "Dank Drop";
  } else {
      echo "Error dropping table: " . $conn->error;
  }*/


  $sql = "CREATE TABLE ROOMS(
  name VARCHAR(20) PRIMARY KEY,
  capacity INT(3),
  features VARCHAR(100),
  type VARCHAR(15),
  ignores BOOLEAN
  )";

  if ($conn->query($sql) === TRUE) {
    echo "Table ROOMS created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  addRoom('ART 102', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 103', 121, 'Projector - Overhead transparency, A/V System, Whiteboard, Microphone', 'Classroom','FALSE');
  addRoom('ART 104', 46, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 106', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 108', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 110', 46, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 112', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 114', 100, 'Tables, Projector - Overhead transparency, DVD/Blu-ray, A/V System, Microphone', 'Classroom','FALSE');
  addRoom('ART 202', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 203', 24, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 204', 48, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 206', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 208', 42, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 210', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 214', 93, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone, DVD/Blu-ray', 'Classroom','FALSE');
  addRoom('ART 215', 41, 'PC', 'Computer Lab','FALSE');
  addRoom('ART 218', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('ART 219', 45, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard, DVD/Blu-ray, VCR', 'Classroom','FALSE');
  addRoom('ART 281', 40, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 365', 35, 'Tables - Moveable', 'Classroom','FALSE');
  addRoom('ART 366', 200, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom','FALSE');
  addRoom('ART 374', 33, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 376', 102, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom','FALSE');
  addRoom('ART 382', 18, 'Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('ART 386', 95, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom','FALSE');
  addRoom('ASC 130', 120, 'Tables', 'Classroom','FALSE'); #Manual Check
  addRoom('ASC 140', 302, 'Tables', 'Classroom','FALSE');  #Manual Check
  addRoom('ASC 165', 31, 'PC, A/V System, Projector', 'Computer Lab','FALSE');
  addRoom('EME 0050', 180, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone, DVD/Blu-ray', 'Classroom','FALSE');
  addRoom('EME 1101', 80, 'Tables,  Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 1121', 72, 'Tables,  Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 1151', 50, 'Tables,  Projector - Overhead transparency, A/V System, Microphone', 'Classroom','FALSE');
  addRoom('EME 1153', 48, 'Tables, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 1202', 60, 'Tables - Moveable, Whiteboard', 'Classroom','FALSE');
  addRoom('EME 2111', 60, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 2141', 70, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 2181', 50, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('EME 2202', 30, 'Restricted', 'Classroom','FALSE'); #Manual Check
  addRoom('EME 2205', 27, 'PC', 'Computer Lab','FALSE');
  addRoom('FIP 121', 70, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Microphone, DVD/Blu-ray', 'Classroom','FALSE');
  addRoom('FIP 124', 32, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('FIP 129', 21, 'PC', 'Computer Lab','FALSE');
  addRoom('FIP 133', 21, 'PC', 'Computer Lab','FALSE');
  addRoom('FIP 138', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('FIP 139', 34, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('FIP 140', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('FIP 204', 300, 'Tables', 'Classroom','FALSE'); #Manual check
  addRoom('FIP 239', 30, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('FIP 247', 20, 'Projector - Overhead transparency, A/V System, Whiteboard, Restricted', 'Labratory','FALSE'); #Manual Check
  addRoom('FIP 250', 32, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('LIB 303', 25, 'Tables - Moveable', 'Classroom','FALSE');
  addRoom('LIB L302', 25, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('LIB L304', 45, 'Tables - Moveable', 'Classroom','FALSE');
  addRoom('LIB L305', 100, 'Tables - Moveable, Projector - Overhead transparency, A/V System', 'Classroom','FALSE');
  addRoom('LIB L306', 45, 'Tables - Moveable, Projector - Overhead transparency, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('LIB L312', 120, 'Tables, Projector - Overhead transparency, A/V System, Microphone', 'Classroom','FALSE');
  addRoom('LIB L317', 130, 'Tables, Projector - Overhead transparency, A/V System, Microphone', 'Classroom','FALSE');
  addRoom('SCI 234', 31, 'PC', 'Computer Lab','FALSE');
  addRoom('SCI 236', 31, 'Tables - Moveable, Projector, A/V System, Whiteboard', 'Classroom','FALSE');
  addRoom('SCI 247', 80, 'Tables, Projector - Overhead transparency, A/V System, Whiteboard, Chalkboard', 'Classroom','FALSE');
  addRoom('SCI 333', 109, 'Tables, Projector - Overhead transparency, A/V System, Document Camera, Microphone', 'Classroom','FALSE');
  addRoom('SCI 337', 104, 'Tables, Projector - Overhead transparency, A/V System, Whiteboard, Document Camera, Microphone', 'Classroom','FALSE');
  addRoom('SCI 396', 40, 'Tables - Moveable, Projector, A/V System', 'Classroom','FALSE');
  addRoom('SCI 126',21,'PC, Projector - Overhead, Whiteboard', 'Computer Lab','FALSE');
  addRoom('SCI 128',31,'MAC, Projector - Overhead','Computer Lab','FALSE');
 ?>
