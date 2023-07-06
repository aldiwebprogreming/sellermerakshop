

<!-- Services -->
<section class="pt-5 pb-5" id="detket">
    <div class="container">

    </div>
</section>
<!-- End Services -->

<!-- Menu mobile -->
<section class="pt-5 pb-5" id="menumobile">
    <div class="container">
        <div class="row">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Hello, </strong>Pesan beras tanpa keluar rumah dengan ratumerakshop.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col-4">
            <center>
                <a href="<?= base_url('shop/produk/premium-rice') ?>">
                    <img src="<?= base_url('assets/img/brand/rice.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;">
                    <small>Premium</small>
                </a>
            </center>
        </div>
        <!-- <div class="col-3">
            <center>
               <a href="<?= base_url('shop/produk/medium-rice') ?>">
                <img src="<?= base_url('assets/img/brand/rice2.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;">
                <small>Medium</small>
            </a>
        </center>
    </div> -->
   <!--  <div class="col-3">
        <center>
         <a href="<?= base_url('shop/produk/healthy-rice') ?>">
            <img src="<?= base_url('assets/img/brand/rice3.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;">
            <small>Healthy</small>
        </a>
    </center>
</div>
<div class="col-3">
    <center>
     <a href="<?= base_url('shop/produk/glutinous-rice') ?>">
        <img src="<?= base_url('assets/img/brand/rice4.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;">
        <small>Glutinous</small>
    </a>
</center>
</div> -->
<div class="col-4 mt-1">
    <center>
       <a href="<?= base_url('shop/produk/spesial-promo-product') ?>">
        <img src="<?= base_url('assets/img/brand/promo.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;"><br>
        <small>Promo</small>
    </a>
</center>
</div>

<div class="col-4 mt-1">
    <center>
       <a target="_blank" href="https://ratumerak.id/reffral/member-69887">
        <img src="<?= base_url('assets/img/brand/aff.png') ?>" class="img-fluid" alt="Responsive image" style="height: 50px;"><br>
        <small>Afiliasi</small>
    </a>
</center>
</div>
            <!-- <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-info mr-4">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="media-body">
                        <h5>Fast Shipping</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-purple mr-4">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="media">
                    <div class="iconbox iconmedium rounded-circle text-warning mr-4">
                        <i class="fa fa-refresh"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Return</h5>
                        <p class="text-muted">
                            All you have to do is to bring your passion. We take care of the rest.
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>



<section class="products-grids trending pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title float-left">
                    <h2>List order</h2>
                </div>

                <div class="section-title float-right">
                    <a href="" class="btn btn-primary btn-sm">See all products <i class="fa fa-list"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-5" id="loadproduk">
            <div class="col-xl-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row"> 
                        <div class="col xl-6 mt-2">
                            <div class="card shadow">
                                <div class="card-body">
                                    <?php foreach ($order as $data) { 
                                        $produk = $this->db->get_where('tbl_produk_stok', ['id' => $data['id_produk']])->row_array();
                                        ?>
                                        <div class="row">
                                            <div class="col-xl-6 ">
                                                <img src="<?= base_url('') ?>/assets/img/products/produkratumerak.png" class="img-fluid" alt="Responsive image">
                                            </div>

                                            <div class="col-xl-6">
                                                <h4><?= $produk['nama'] ?></h4>
                                                <p>Rp <?= number_format($produk['harga'],0,',','.')  ?></p>
                                                <p>Qty : <?= $data['qty'] ?></p>
                                                <p class="font-weight-bold">Total :  Rp. <?=  number_format($data['total_harga'],0,',','.') ?> </p>
                                                <hr>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="card shadow mt-2">
                                <div class="card-body">
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                   quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                   consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                   cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                   proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                               </div>
                           </div>
                       </div>

                       <div class="col xl-6 mt-2">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pengantaran</label>
                                    <?php 
                                    $id_alamat = $ck['alamat_pengantaran'];

                                    $alamat = $this->db->get_where('tbl_alamat_pengantaran_user', ['id' => $id_alamat])->row_array();

                                    $kab = $this->db->get_where('tbl_kabupaten', ['id'=> $alamat['kab']])->row_array();
                                    $kec = $this->db->get_where('tbl_kecamatan', ['id'=> $alamat['kec']])->row_array();
                                    $kel = $this->db->get_where('tbl_kelurahan', ['id'=> $alamat['kel']])->row_array();
                                    ?>

                                    <p> <?= $kab['name'] ?>, <?= $kec['name'] ?>, <?= $kel['name'] ?></p>
                                    <small><?= $alamat['alamat'] ?></small>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pembayaran</label><br>
                                    <?php   
                                    if ($ck['pembayaran'] == 'bank') {
                                        echo "Bank Transper";
                                    }else{
                                        echo "COD";
                                    }
                                    ?>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total pembayaran</label>
                                    <p>Rp <?=  number_format($ck['total_pembayaran'],0,',','.') ?></p>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Status pembayaran</label>

                                    <?php   
                                    if ($ck['status_upload_pembayaran'] == 0) {
                                        ?>
                                        <p class="text-danger">Belum ada melakukan pembayaran</p>
                                    <?php   }else{ ?>
                                        <p class="text-success">Bukti pembayaran masih di tinjau oleh admin </p>
                                        <a href="" data-toggle="modal" data-target="#exampleModalbukti">Lihat bukti pembayaran ||</a>
                                    <?php   } ?>

                                    <a href="" data-toggle="modal" data-target="#exampleModalpembayaran">Lihat pembayaran</a>

                                    <!-- Modal lihat pembayaran -->
                                    <div class="modal fade" id="exampleModalpembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                        <p class="">Anda dapat melakukan pembayaran ke nomor rekening ini : <b>BCA 647577111 a/n PT SINAR ANEKA NUSANTARA </b> dengan jumlah pembayaran yang sudah di tentukan.</p>
                                        <h4 class="text-center"> Total Pembayaran : <br><b>Rp <?=  number_format($ck['total_pembayaran'],0,',','.') ?></b></h4>
                                    </div>
                                    <div class="modal-footer" style="border : 0px;">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal lihat bukti -->
                        <div class="modal fade" id="exampleModalbukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <?php 
                                        $name = $this->db->get_where('tbl_register', ['kode_user' => $bukti['kode_user']])->row_array();
                                        ?>
                                        <p><?= $name['name'] ?></p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Total Pembayaran</label>
                                        <p>Rp <?= number_format($bukti['jumlah_pembayaran'],0,',','.')  ?></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <p><?= $bukti['bank_pengirim'] ?></p>
                                    </div>
                                    <hr>
                                </div>


                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Nama Rekening</label>
                                        <p><?= $bukti['nama_rekening'] ?></p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Tanggal Pembayaran</label>
                                        <p><?= $bukti['tgl_pembayaran'] ?></p>
                                    </div>

                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>Bukti Pembayaran</label>
                                        <a target="_blank" href="<?= base_url('assets/bukti/') ?><?= $bukti['bukti_pembayaran'] ?>">
                                            <img src="<?= base_url('assets/bukti/') ?><?= $bukti['bukti_pembayaran'] ?>" style="height: 200px; width: 200px">
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer" style="border : 0px;">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

                        </div>
                    </div>




                    <hr>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Status pengantaran</label>

                        <?php 
                        if ($ck['status_pembayaran' ] == 0) {
                         ?>
                         <p class="text-danger"> Belum ada pengantaran </p>

                     <?php }else{ ?>
                         <p class="text-success">Pengantaran sedang di proses</p>
                     <?php } ?>

                 </div>
                 <hr>

                 <?php   if ($ck['status_upload_pembayaran'] == 1) {

                 }else{ ?>
                     <form method="post" action="<?= base_url('store/upload_bukti') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Bank Pengirim</label>
                            <input type="text" class="form-control" name="bank_pengirim" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" required>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tgl Pembayaran</label>
                            <input type="date" class="form-control" name="tgl_pembayaran" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Upload Bukti pembayaran</label>
                            <input type="file" class="form-control" name="bukti" required>
                        </div>
                        <input type="hidden" name="kode_order" value="<?= $ck['kode_order'] ?>">
                        <input type="hidden" name="kode_user" value="<?= $ck['kode_user'] ?>">
                        <input type="hidden" name="kode_seller" value="<?= $ck['kode_seller'] ?>">
                        <input type="hidden" name="jumlah_pembayaran" value="<?= $ck['total_pembayaran'] ?>">
                        <input type="hidden" name="alamat_pengantaran" value="<?= $ck['alamat_pengantaran'] ?>">

                        <?php if($ck['pembayaran'] == 'bank'){ ?>
                            <div class="form-group">
                             <button class="btn btn-success btn-block">Upload Bukti</button>
                         </div>
                     </form>
                 <?php }else{ ?>

                 <?php } ?>
             <?php    } ?>
         </div>
     </div>
 </div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $("#plus").click(function(){
            const qty = $("#qty").val();
            if (qty >= 0) {

                $("#min").removeCla ss('disabled');
                const tambah =  Number(qty) + 1;
                $("#qty").val(tambah);

                const url = "<?= base_url('store/cart?id=') ?>"+<?= $produk['id'] ?>+"&idseller="+<?= $seller['id'] ?>+"&qty="+tambah+"&kode="+"<?= $kode ?>";
                $("#cartorder").load(url);

            }

        });


        $("#min").click(function(){
            const qty = $("#qty").val();
            if (qty <= 0) {
                $("#min").addClass('disabled');
            }else{

                const kurang = Number(qty) - 1;
                $("#qty").val(kurang);

                const kodeorder = "<?= $kode ?>";
                const url = "<?= base_url('store/cartmin?kode=') ?>"+"<?= $kode ?>"+"&qty="+kurang; 
                $("#cartorder").load(url)
            }
        });
    })
</script>




