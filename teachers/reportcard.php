<?php
session_start();

if (isset($_SESSION['teachers_list']) && $_SESSION['teachers_list'] == 'teacher_list') {
    header('location: ./login.php');
    exit(); 
    
    $title = 'Home';
    require_once('../includes/head.report.php');
?>

<body>
<?php
    require_once('../includes/sidebar.php');
?>  

<div class="main p-3">
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary me-md-2" type="button">Back</button>
      </div>
  <img src="../images/final-logo.png" class="studentpic">
            <table class="table table-striped table-hover table-bordered" style="border: solid 1px black;">
  <thead>
  <tr>
          <td rowspan="3">Subject </td>
          <td colspan="4"> Quarter </td>
          <td rowspan="2"> Grade </td>
        </tr>
    <tr>
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
    </tr>
  </thead>
  <tbody>
  <tr>
          <td>Mathematics </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>Science </td>
          <td > </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>English </td>
          <td > </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>Edukasyon sa Pagpapakatao </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>Araling Panlipunan </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>MAPEH </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>Filipino </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
        <tr>
          <td>Technology and Livelihood 
            Education (TLE) </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td> <!-- Final Grade -->
        </tr>
  </tbody>
  <tfoot>
  <tr>
          <td colspan="4" class="footer">General Average</td>
          
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="4" class="footer">Promoted To</td>
          <td colspan="3"> </td>
        </tr>
  </tfoot>
</table>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary me-md-2" type="button">Promote</button>
  
</div>
    <main>
        
    </main>
</body>

<?php
    
    require_once('../includes/script.js.php');
?>
</html>