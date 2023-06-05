<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul?></h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modaltambah">
        <i class="fa fa-plus"></i> Tambah Data
    </button>

    <div class="row">
        <div class="col-12">
            <?php 
                if (session()->get('err')) {
                    echo "<div class='alert alert-danger' role='alert'>". session()->get('err') ."</div>";
                    session()->remove('err');
                }
            ?>
        </div>
    </div>
    
    <!-- flashdata tambah -->
    <?php if(session()->get('pesan')):?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!!</strong> Data Siswa Berhasil <?= session()->getFlashdata('pesan');?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;?>

    <!-- flashdata hapus -->
    <?php if(session()->get('hapus')):?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Selamat!!</strong> Data Siswa Berhasil <?= session()->getFlashdata('hapus');?>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif;?>

    <div class="card">
        <div class="card-header text-center">
            <h5>Data Siswa</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive-lg text-center">
                <tr>
                    <th>No</th>
                    <th>Nisn</th>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
                <?php $no = 1; foreach($siswa as $siswa):?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $siswa['nisn']?></td>
                    <td><?= $siswa['nama']?></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalubah" id="btn-edit" data-id="<?= $siswa['id']?>" data-nisn="<?= $siswa['nisn']?>" data-nama="<?= $siswa['nama']?>">
                        <i class="fa fa-edit"></i>
                      </button> |
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalhapus" id="btn-hapus" data-id="<?= $siswa['id']?>" data-nisn="<?= $siswa['nisn']?>" data-nama="<?= $siswa['nama']?>">
                        <i class="fa fa-trash-alt"></i>
                      </button>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal Tambah Data-->
<div class="modal fade" id="modaltambah">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah <?= $judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('siswa/tambah')?>" method="post">
            <div class="form-group">
              <label for="nisn">NISN</label>
              <input type="number" name="nisn" id="nisn" class="form-control" placeholder="Masukan Nisn Anda">
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anda">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal Hapus Data-->
<div class="modal fade" id="modalhapus">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('siswa/hapus')?>" method="post">
            <div class="form-group">
              <h5>Apakah Anda Ingin Menghapus Data Ini?</h5>
              <input type="hidden" name="id" id="id">
            </div>
            <div class="form-group">
              <input type="text" name="nisn" id="nisn" class="form-control" disabled>
            </div>
            <div class="form-group">
              <input type="text" name="nama" id="nama" class="form-control" disabled>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="hapus" class="btn btn-danger">
          <i class="fa fa-trash-alt"></i> Hapus Data
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="fa fa-reply-all"></i> Back
        </button>
      </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal ubah Data-->
<div class="modal fade" id="modalubah">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('siswa/ubah')?>" method="post">
            <div class="form-group">
              <input type="hidden" name="id" id="id">
              <label for="nisn">NISN</label>
              <input type="number" name="nisn" id="nisn" class="form-control" placeholder="Masukan Nisn Anda">
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anda">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
        </form>
    </div>
  </div>
</div>