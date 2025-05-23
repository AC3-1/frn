<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Equipment Status - FRN. Gym</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css_equip/equip.css">
   <script src="js_equip/equip.js" defer></script>
</head>
<body>
<nav class="navbar">
  <div class="nav-container">
    <a href="front.html"><div class="logo">frn.</div></a>
    <div class="menu-toggle" id="menuToggle">&#9776;</div>
    <ul class="nav-links" id="navLinks">
      <li><a href="#programs">Programs</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </div>
</nav>
<div class="container">
   <h3 class="title"> Equipment Status </h3>

   <div class="equipment-container">
      <div class="equipment" data-name="p-1">
         <img src="images_equip/1.png" alt="">
         <h3>Cable Pull Machine</h3>
         <div class="status-label">Working</div>
      </div>

      <div class="equipment" data-name="p-2">
         <img src="images_equip/2.png" alt="">
         <h3>Leg Extension Machine</h3>
         <div class="status-label">Working</div>
      </div>

      <div class="equipment" data-name="p-3">
         <img src="images_equip/3.webp" alt="">
         <h3>Leg Press Machine</h3>
         <div class="status-label">Working</div>
      </div>

      <div class="equipment" data-name="p-4">
         <img src="images_equip/1.png" alt="">
         <h3>Cable Pull Machine</h3>
         <div class="status-label">Working</div>
      </div>

      <div class="equipment" data-name="p-5">
         <img src="images_equip/1.png" alt="">
         <h3>Cable Pull Machine</h3>
         <div class="status-label">Working</div>
      </div>

      <div class="equipment" data-name="p-6">
         <img src="images_equip/1.png" alt="">
         <h3>Cable Pull Machine</h3>
         <div class="status-label">Working</div>
      </div>
   </div>
</div>

<div class="equipment-preview">
   <div class="preview" data-target="p-1">
      <i class="fas fa-times"></i>
      <img src="images_equip/1.png" alt="">
      <h3>Cable Pull Machine</h3>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>

   <div class="preview" data-target="p-2">
      <i class="fas fa-times"></i>
      <img src="images_equip/2.png" alt="">
      <h3>Leg Extension Machine</h3>
      <div class="stars"></div>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>

   <div class="preview" data-target="p-3">
      <i class="fas fa-times"></i>
      <img src="images_equip/3.webp" alt="">
      <h3>Leg Press Machine</h3>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>

   <div class="preview" data-target="p-4">
      <i class="fas fa-times"></i>
      <img src="images_equip/1.png" alt="">
      <h3>Cable Pull Machine</h3>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>

   <div class="preview" data-target="p-5">
      <i class="fas fa-times"></i>
      <img src="images_equip/1.png" alt="">
      <h3>Cable Pull Machine</h3>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>

   <div class="preview" data-target="p-6">
      <i class="fas fa-times"></i>
      <img src="images_equip/1.png" alt="">
      <h3>Cable Pull Machine</h3>
      <p>This equipment is currently <br><strong class="status-label">Working</strong></p>
      <div class="buttons">
         <button class="toggle-status">Toggle Status</button>
      </div>
   </div>
</div>



<!-- Report Card Modal -->
<div id="reportCardModal" class="modal">
  <div class="modal-content">
    <span class="close-button" id="closeModal">&times;</span>
    <h2>Maintenance Report</h2>
    <p>Please describe the issue:</p>
    <textarea id="maintenanceReason" rows="5" placeholder="Describe the problem..."></textarea>
    <button id="submitReport">Submit</button>
  </div>
</div>

</body>
</html>
