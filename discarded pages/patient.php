<?php include '../layouts/header.php'?>

<section class="admin-doctor">
    <div class="sidenav">
        <h2 class="text-center">Admin Menu</h2>
        <a href="#">Dashboard</a>
        <a href="#">Appointments</a>
        <a href="#">Doctors</a>
        <a href="#" class="active">Patients</a>
        <a href="#">Reports</a>
        <a href="#">Settings</a>
    </div>

    <div class="main">
        <a href="#" class="btn btn-outline-danger logout-btn">Logout</a>
        
        <div class="text-center button-container">
            <h2>Patients Management</h2>
            <button class="btn btn-secondary mb-3" onclick="window.history.back();">Back</button>
        </div>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPatientModal">Add Patient</button>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Jane Doe</td>
                    <td>30</td>
                    <td>(555) 123-4567</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPatientModal">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>John Smith</td>
                    <td>45</td>
                    <td>(555) 987-6543</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPatientModal">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add Patient Modal -->
        <div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPatientModalLabel">Add Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="patientName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="patientName" required>
                            </div>
                            <div class="mb-3">
                                <label for="patientAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="patientAge" required>
                            </div>
                            <div class="mb-3">
                                <label for="patientContact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="patientContact" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add Patient</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Patient Modal -->
        <div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="editPatientName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editPatientName" value="Jane Doe" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPatientAge" class="form-label">Age</label>
                                <input type="number" class="form-control" id="editPatientAge" value="30" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPatientContact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="editPatientContact" value="(555) 123-4567" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning">Update Patient</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>