<?php
include 'connection.php'; // Database connection
$message = "";

include '../layouts/header.php';

// Handle adding a doctor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addDoctor'])) {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $specialization = $_POST['specialization'] ?? '';

    // Fetch last did
    $sql_get_last_did = "SELECT did FROM doctorlogin ORDER BY did DESC LIMIT 1";
    $result = $conn->query($sql_get_last_did);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_did = $row['did'];
        $numeric_part = (int) substr($last_did, 1);
        $new_numeric_part = $numeric_part + 1;
        $new_did = 'D' . str_pad($new_numeric_part, 4, '0', STR_PAD_LEFT);
    } else {
        $new_did = 'D0001';
    }

    // Create default password
    $sql_get_last_password = "SELECT password FROM doctorlogin ORDER BY did DESC LIMIT 1";
    $result_password = $conn->query($sql_get_last_password);
    $num = ($result_password->num_rows > 0) ? (int) substr($result_password->fetch_assoc()['password'], 7) + 1 : 5;
    $new_password = "doctor" . $num;

    // Insert into doctorlogin
    $sql_insert_login = "INSERT INTO doctorlogin (did, password) VALUES ('$new_did', '$new_password')";
    if ($conn->query($sql_insert_login) === TRUE) {
        $sql_insert_doctor = "INSERT INTO doctorinfo (did, name, surname, gender, specialization) VALUES ('$new_did', '$name', '$surname', '$gender', '$specialization')";
        if ($conn->query($sql_insert_doctor) === TRUE) {
            $message = "Doctor added successfully!";
        } else {
            $message = "Error inserting into doctorinfo: " . $conn->error;
        }
    } else {
        $message = "Error inserting into doctorlogin: " . $conn->error;
    }
}

// Handle deleting a doctor
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // First delete from doctorpatient (if exists)
        $conn->query("DELETE FROM doctorpatient WHERE did='$delete_id'");
        
        // Then delete from doctorinfo
        $conn->query("DELETE FROM doctorinfo WHERE did='$delete_id'");
        
        // Finally delete from doctorlogin
        $conn->query("DELETE FROM doctorlogin WHERE did='$delete_id'");
        
        // Commit transaction
        $conn->commit();
        $message = "Doctor deleted successfully!";
    } catch (Exception $e) {
        // Rollback transaction if any error occurs
        $conn->rollback();
        $message = "Error deleting doctor: " . $e->getMessage();
    }
}

// Handle editing a doctor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editDoctor'])) {
    $did = $_POST['did'] ?? '';
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $specialization = $_POST['specialization'] ?? '';

    $sql_update_doctor = "UPDATE doctorinfo SET name='$name', surname='$surname', gender='$gender', specialization='$specialization' WHERE did='$did'";
    if ($conn->query($sql_update_doctor) === TRUE) {
        $message = "Doctor updated successfully!";
    } else {
        $message = "Error updating doctor: " . $conn->error;
    }
}

$doctors = $conn->query("SELECT * FROM doctorinfo");
$conn->close();
?>

<section class="admin-doctor">
    <div class="main container mt-4">
        <button class="btn btn-outline-secondary float-start" onclick="window.location.href='../pages/adminPage.php';">Back</button> 
        <h2 class="text-center">Doctors Management</h2>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDoctorModal">Add Doctor</button>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $doctors->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['did']; ?></td>
                        <td><?php echo $row['name'] . ' ' . $row['surname']; ?></td>
                        <td><?php echo $row['specialization']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDoctorModal" data-id="<?php echo $row['did']; ?>" data-name="<?php echo $row['name']; ?>" data-surname="<?php echo $row['surname']; ?>" data-gender="<?php echo $row['gender']; ?>" data-specialization="<?php echo $row['specialization']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <a href="?delete_id=<?php echo $row['did']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this doctor?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add Doctor Modal -->
        <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDoctorModalLabel">Add Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Surname:</label>
                                <input type="text" name="surname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender">Gender:</label>
                                <select name="gender" class="form-select" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="specialization" class="form-label">Specialization:</label>
                                <input type="text" name="specialization" class="form-control" required>
                            </div>
                            <button type="submit" name="addDoctor" class="btn btn-primary">Add Doctor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Doctor Modal -->
        <div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="did" id="editDoctorId">
                            <div class="mb-3">
                                <label for="editDoctorName" class="form-label">First Name:</label>
                                <input type="text" name="name" class="form-control" id="editDoctorName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDoctorSurname" class="form-label">Surname:</label>
                                <input type="text" name="surname" class="form-control" id="editDoctorSurname" required>
                            </div>
                            <div class="mb-3">
                                <label for="editGender">Gender:</label>
                                <select name="gender" class="form-select" id="editGender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editSpecialization" class="form-label">Specialization:</label>
                                <input type="text" name="specialization" class="form-control" id="editSpecialization" required>
                            </div>
                            <button type="submit" name="editDoctor" class="btn btn-warning">Update Doctor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
    $('#editDoctorModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var surname = button.data('surname');
        var gender = button.data('gender');
        var specialization = button.data('specialization');

        var modal = $(this);
        modal.find('#editDoctorId').val(id);
        modal.find('#editDoctorName').val(name);
        modal.find('#editDoctorSurname').val(surname);
        modal.find('#editGender').val(gender);
        modal.find('#editSpecialization').val(specialization);
    });
</script>
