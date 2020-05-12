<script>
/* Open bar */
function openNav() {
    if(document.getElementById("mySidebar").style.width = "0"){
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
        document.getElementsByName("row").style.marginLeft = "250";
    }else{
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
}
/* Close Bar - Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
  document.getElementsByClassName("row").style.marginLeft = "0";
}
  </script>
       
       <!--- Left sidebar content --->
        <div id="mySidebar" class="sidebar bg-dark " style="">
            <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="#" class="" onclick="closeNav()" style="text-align: center;"> &times;  Close</a>
            <a href="#" class="sidebarItem" data-target="getStarted">Get Started</a>
            <a href="#" class="sidebarItem" data-target="hardware">Hardware</a>
            <a href="#" class="sidebarItem" data-target="getStarted">Software</a>
            <a href="#">Connectivity</a>
            <a href="#">Contact Us</a> 
        </div>
     <!--- Left sidebar opening button --->        
        <div id="main">
              <button class="openbtn bg-dark" onclick="openNav()">&#9776; Troubleshooting</button>
        </div>