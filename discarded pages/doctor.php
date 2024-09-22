<?php include '../layouts/header.php'?>

<section class="admin-doctor">
    <div class="main">
        <button class="btn btn-outline-secondary" onclick="window.history.back();">Back</button>
        <a href="#" class="btn btn-outline-danger logout-btn">Logout</a>
        <h2 class="text-center">Doctors Management</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDoctorModal">Add Doctor</button>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dr. John Smith</td>
                    <td>Cardiology</td>
                    <td>(555) 123-4567</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDoctorModal"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Dr. Jane Doe</td>
                    <td>Pediatrics</td>
                    <td>(555) 987-6543</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDoctorModal"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
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
                        <form>
                            <div class="mb-3">
                                <label for="doctorName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="doctorName" required>
                            </div>
                            <div class="mb-3">
                                <label for="specialization" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="specialization" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="contact" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Add Doctor</button>
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
                        <form>
                            <div class="mb-3">
                                <label for="editDoctorName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editDoctorName" value="Dr. John Smith" required>
                            </div>
                            <div class="mb-3">
                                <label for="editSpecialization" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="editSpecialization" value="Cardiology" required>
                            </div>
                            <div class="mb-3">
                                <label for="editContact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="editContact" value="(555) 123-4567" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning">Update Doctor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>