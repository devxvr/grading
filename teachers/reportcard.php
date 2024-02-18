<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Report Card';
    require_once('../includes/head.report.php');
?>
<body>
<?php
    require_once('../includes/sidebar.php');
?>  
<table class="reportCard">
      <thead>
        <tr>
          <td rowspan="3">Subject </td>
          <td colspan="4"> Quarter </td>
          <td rowspan="2"> Grade </td>
        </tr>
        <tr>
          <td> 1st</td>
          <td> 2nd </td>
          <td> 3rd </td>
          <td> 4th </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Mathematics </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>Science </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>English </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>Edukasyon sa Pagpapakatao </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>Araling Panlipunan </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>MAPEH </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>Filipino </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
        </tr>
        <tr>
          <td>Technology and Livelihood 
            Education (TLE) </td>
          <td > </td>
          <td> </td>
          <td>  </td>
          <td>  </td>
          <td> </td>
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
    </table>
</body>
<?php
    
    require_once('../includes/sidebarjs.php');
?>
</html>