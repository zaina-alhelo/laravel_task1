<?php 
include ("event/includes/header.php")
 ?>
<?php include ("event/includes/sidebar.php") ?>
<?php
include "test.php";
include 'connection.php';


$deleteMessage = '';
$deleteStatus = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {


  $userID = $_POST['user_id'];
  echo "<h1>User ID: $userID</h1>"; 

  $stmt1 = $conn->prepare("DELETE FROM  reviews where user_id = ?");
  $stmt1->bind_param("i", $userID);

  $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? ");
  $stmt->bind_param("i", $userID);
$stmt1->execute();
  if ($stmt->execute()) {
    $deleteMessage = "The user has been deleted successfully.";
    $deleteStatus = "success";
  } else {
    $deleteMessage = "Error: " . $stmt->error;
    $deleteStatus = "error";
  }

  $stmt->close();
  $stmt1->close();
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Information</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div>
<section>
<div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Events </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $row2['tcount']; ?></h6>

        </div>
      </div>
    </div>

    <div class="card info-card revenue-card">

    <div class="card-body">
      <h5 class="card-title">Tickets </h5>

      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-currency-dollar"></i>
        </div>
        <div class="ps-3">
          <h6><?php echo $row['count']; ?></h6>
    
          </div>
        </div>
      </div>
    
    </div>
    
  <div class="card-body">
    <h5 class="card-title">Users</h5>

    <div class="d-flex align-items-center">
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-people"></i>
      </div>
      <div class="ps-3">
        <h6><?php echo $row1['ucount']; ?></h6>
    
        </div>
      </div>
    
    </div>
  </div>
</div>

<div class="col-xxl-4 col-md-4">
  <div class="card info-card revenue-card">

    <div class="card-body">
      <h5 class="card-title">Tickets </h5>

      <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
          <i class="bi bi-currency-dollar"></i>
        </div>
        <div class="ps-3">
          <h6><?php echo $row['count']; ?></h6>

        </div>
      </div>
    </div>

  </div>
</div>

<div class="card info-card customers-card">



  <div class="card-body">
    <h5 class="card-title">Users</h5>

    <div class="d-flex align-items-center">
      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-people"></i>
      </div>
      <div class="ps-3">
        <h6><?php echo $row1['ucount']; ?></h6>

      </div>
    </div>

  </div>
</div>


</section>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Dear Users</h5>

            <table class="table datatable">
              <thead>
                <tr>
                  <th>UserID</th>
                  <th><b>F</b>name</th>
                  <th><b>L</b>name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th data-type="date" data-format="YYYY/DD/MM">created_at</th>
                  <th>DELETE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT `user_id`, `fname`, `lname`,  `roles`,`email`, `created_at` FROM `users`";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['fname']}</td>";
                    echo "<td>{$row['lname']}</td>";
                    echo "<td>{$row['roles']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td>";
                    echo "<form id='deleteForm{$row['user_id']}' action='{$_SERVER['PHP_SELF']}' method='post' style='display:inline;'>";
                    echo "<input type='hidden' name='user_id' value='{$row['user_id']}'>";
                    echo "<button type='submit' name='delete' onclick='confirmDelete(event, {$row['user_id']});' class='btn btn-danger btn-sm'><i class=\"bi bi-person-x-fill\" style=\"font-size:1.2em;\"></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                  }
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
//   document.addEventListener('DOMContentLoaded', function () {
//     <?php if ($deleteMessage): ?>
//       Swal.fire({
//         title: '<?php echo $deleteStatus == "success" ? "Deleted!" : "Error!"; ?>',
//         text: '<?php echo $deleteMessage; ?>',
//         icon: '<?php echo $deleteStatus; ?>'
//       });
//     <?php endif; ?>
//   });

//   function confirmDelete(event, user_id) {
//     event.preventDefault();
//     Swal.fire({
//       title: 'Are you sure?',
//       text: "You won't be able to revert this!",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: '#3085d6',
//       cancelButtonColor: '#d33',
//       confirmButtonText: 'Yes, delete it!',
//       cancelButtonText: 'Cancel'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         const form = document.querySelector(`form[id="deleteForm${user_id}"]`);
//         if (form) {
//           form.submit();
//         } else {
//           console.error('Form not found:', `deleteForm${user_id}`);
//         }
//       }
//     });
//   }
// </script>

<?php include ("event/includes/footer.php"); ?>