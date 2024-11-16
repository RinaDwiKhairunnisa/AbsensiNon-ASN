<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
        }
        .sidebar {
            height: 100%;
            position: fixed;
            width: 220px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            color: #ffffff;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .container {
            margin-left: 240px;
            padding-top: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -220px;
                width: 220px;
            }
            .sidebar.active {
                left: 0;
            }
            .container {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-center">Menu</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('absensi/dashboard_admin'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo site_url('absensi/data_karyawan'); ?>">Data Karyawan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('absensi/data_user'); ?>">Data User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('absensi/data_jabatan'); ?>">Data Jabatan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('absensi/data_absen'); ?>">Data Absen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('absensi/keterangan'); ?>">Keterangan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
            </li>
        </ul>
    </div>

    <div class="container mt-3">
        <h1 class="mt-3">Data Karyawan</h1>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form id="dataForm" action="<?php echo site_url('karyawan/simpan'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_karyawan" value="<?php echo isset($karyawan->id_karyawan) ? $karyawan->id_karyawan : ''; ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tempat_tanggal_lahir">Tempat Tanggal Lahir</label>
                <input type="text" class="form-control" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" required>
            </div>
            <div class="form-group">
                <label for="jenkel">Jenis Kelamin</label>
                <select class="form-control" id="jenkel" name="jenkel" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no_tel">No Telepon</label>
                <input type="text" class="form-control" id="no_tel" name="no_tel" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <h2 class="mt-5">Data Karyawan</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID Karyawan</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Tempat & Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Jabatan</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <?php foreach ($karyawan as $k): ?>
                <tr>
                    <td><?php echo $k->id_karyawan; ?></td>
                    <td><?php echo $k->username; ?></td>
                    <td><?php echo $k->nama; ?></td>
                    <td><?php echo $k->tmp_tgl_lahir; ?></td>
                    <td><?php echo $k->jenkel; ?></td>
                    <td><?php echo $k->agama; ?></td>
                    <td><?php echo $k->alamat; ?></td>
                    <td><?php echo $k->no_tel; ?></td>
                    <td><?php echo $k->jabatan; ?></td>
                    <td><img src="<?php echo base_url('uploads/'.$k->foto); ?>" alt="Foto" width="50"></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editKaryawan(<?php echo $k->id_karyawan; ?>)">Ubah</button>
                        <a href="<?php echo site_url('karyawan/hapus/'.$k->id_karyawan); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editKaryawanModal" tabindex="-1" aria-labelledby="editKaryawanModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editKaryawanModalLabel">Edit Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="editKaryawanForm" action="<?php echo site_url('karyawan/update'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_karyawan" id="edit_id_karyawan">
              <div class="form-group">
                <label for="edit_username">Username</label>
                <input type="text" class="form-control" id="edit_username" name="username" required>
              </div>
              <div class="form-group">
                <label for="edit_nama">Nama</label>
                <input type="text" class="form-control" id="edit_nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="edit_tempat_tanggal_lahir">Tempat Tanggal Lahir</label>
                <input type="text" class="form-control" id="edit_tempat_tanggal_lahir" name="tempat_tanggal_lahir" required>
              </div>
              <div class="form-group">
                <label for="edit_jenkel">Jenis Kelamin</label>
                <select class="form-control" id="edit_jenkel" name="jenkel" required>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit_agama">Agama</label>
                <select class="form-control" id="edit_agama" name="agama" required>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buddha">Buddha</option>
                  <option value="Konghucu">Konghucu</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="form-group">
                <label for="edit_alamat">Alamat</label>
                <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
              </div>
              <div class="form-group">
                <label for="edit_no_tel">No Telepon</label>
                <input type="text" class="form-control" id="edit_no_tel" name="no_tel" required>
              </div>
              <div class="form-group">
                <label for="edit_jabatan">Jabatan</label>
                <input type="text" class="form-control" id="edit_jabatan" name="jabatan" required>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      function editKaryawan(id) {
        $.ajax({
          url: '<?php echo site_url('karyawan/get_karyawan_by_id/'); ?>' + id,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            $('#edit_id_karyawan').val(data.id_karyawan);
            $('#edit_username').val(data.username);
            $('#edit_nama').val(data.nama);
            $('#edit_tempat_tanggal_lahir').val(data.tmp_tgl_lahir);
            $('#edit_jenkel').val(data.jenkel);
            $('#edit_agama').val(data.agama);
            $('#edit_alamat').val(data.alamat);
            $('#edit_no_tel').val(data.no_tel);
            $('#edit_jabatan').val(data.jabatan);
            $('#editKaryawanModal').modal('show');
          }
        });
      }
    </script>
</body>
</html>
