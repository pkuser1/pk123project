<!DOCTYPE html>
<head>
    <meta charset="utf-8">
      <!--CSS-->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
      <!--JAVASCRIPT-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
      <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
      <!--FONTS-->
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
      <!--Dagdag po to sa CSS -->
      <style>
          #sidebar {
              background-color: rgb(255,232,140);
              height: 100vh; 
              position: fixed
          }
          #identity {
              margin-top: 10px;
              font-size: 12px;
          }
          
          #identity img {
              width: 50px;
          }
          
          #search {
              border-bottom: #d9d9d9 3px solid;
          }
          
          #search a {
              color: black;
              font-size: 12;
          }
          
          #search a:hover {
              color: #e69138;
              text-decoration: none;
          }
          .nav-link {
              color: black;
              font-family: roboto;
              font-size: 15px;
              padding-top:20px;
              padding-bottom: 20px;
          }
          .notif {
              position: absolute;
              margin-left: 10px;
              color: white;
              background-color: red;
              font-family: roboto;
              padding: 5px 8px;
              font-size: 7px;
              border-radius: 100%;
              right: 17;
          }
          .nav-link {
              font-size: 12px;
          }
          .nav-link:hover {
              color: white;
          }
          .nav-link img {
              width: 15px;
              margin-right: 10px;
          }
          .nav-item.active {
              background-color: #e69138;
              color: white;
          }
          .nav-item:hover {
              background-color: #e69138;
          }
          .form-control {
              font-size: 12px;
              border: none;
          }
      </style>
      
</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="sidebar">
            <div id="identity">
                <img src="https://i.pinimg.com/originals/7c/c7/a6/7cc7a630624d20f7797cb4c8e93c09c1.png">
                <p> ISMAEL LANGIT <br> Admin </p>
            </div>
          <ul class="nav flex-column">
            <li class="nav-item active">
              <a class="nav-link" href="#"> <img src="https://cdn4.iconfinder.com/data/icons/pictype-free-vector-icons/16/home-512.png"> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/11223-200.png"> History</a>
            <li class="nav-item">
              <a class="nav-link" href="#"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/1024px-User_font_awesome.svg.png"> Employees</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/26202-200.png" width="15"> Establishments </a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link" href="#"> <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/194977-200.png" width=15> Notifications <span class="notif"> 1 </span></a>
            </li>
          </ul>
        </div>
        <div class="col-9" style="margin-left:25%; margin-top: 10px;">
                <div class="continer-fluid" id="search">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <a href="#"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Hamburger_icon.svg/1200px-Hamburger_icon.svg.png" width="30px"/></a>
                                <input type="text" class="form-control" placeholder="Search for something...">
                                <a href="#" style="margin-right: 20px;"> <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/194977-200.png" width="15px" style="margin-top: 3px; "/></a>
                                <a href="#"> <img src="http://www.free-icons-download.net/images/logout-button-icon-76344.png" width="15px;"/> Logout </a>
                            </div>
                        </div>
                    </div>
            </div>
            
            HTML editey diba?
            
            Yep. tulog napo ako. dun mo icreate sa folder na pages
            <!-- CALENDAR
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"> S </th>
                                <th scope="col"> M </th>
                                <th scope="col"> T </th>
                                <th scope="col"> W </th>
                                <th scope="col"> Th </th>
                                <th scope="col"> F </th>
                                <th scope="col"> S </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"> 1 </th>
                                <td> 2 </td>
                                <td> 3 </td>
                                <td> 4 </td>
                                <td> 5 </td>
                                <td> 6 </td>
                                <td> 7 </td>
                            </tr>
                            <tr>
                                <th scope="row" bgcolor ='pink'> 8 &#10004; </th>
                                <td bgcolor ='pink'> 9 &#10004; </td>
                                <td bgcolor ='pink'> 10 &#10004; </td>
                                <td bgcolor ='pink'> 11 &#10004; </td>
                                <td bgcolor ='pink'> 12 &#10004; </td>
                                <td> 13 </td>
                                <td> 14 </td>
                            </tr>
                            <tr>
                                <th scope="row"> 15 </th>
                                <td> 16 </td>
                                <td bgcolor ='green'> 17 &#10004; </td>
                                <td bgcolor ='green'> 18 &#10004; </td>
                                <td bgcolor ='green'> 19 &#10004; </td>
                                <td bgcolor ='green'> 20 &#10004; </td>
                                <td bgcolor ='green'> 21 &#10004; </td>
                            </tr>
                            <tr>
                                <th scope="row"> 22 </th>
                                <td> 23 </td>
                                <td> 24 </td>
                                <td> 25 </td>
                                <td> 26 </td>
                                <td> 27 </td>
                                <td> 28 </td>
                            </tr>
                            <tr>
                                <th scope="row"> 29 </th>
                                <td> 30 </td>
                                <td> 31 </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            -->
        </div>
     </div>