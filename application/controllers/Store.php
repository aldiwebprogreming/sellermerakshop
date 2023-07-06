<?php 

	/**
	 * 
	 */
	class Store extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('cart');
			$this->load->model('M_data');
		}

		function index(){

			$this->db->select('*');
			$this->db->from('tbl_produk');
			$this->db->join('tbl_kategori', 'tbl_kategori.kode_kategori = tbl_produk.kategori');
			$data['produk'] = $this->db->get()->result_array();

			$data['cart'] = $this->cart->contents();

			$data['produk2'] = $this->db->get('tbl_produk_seller')->result_array();

			$data['kec'] = $this->db->get('tbl_kecamatan')->result_array();
			$this->load->view('template_store/header', $data);
			$this->load->view('store/index', $data);
			$this->load->view('template_store/footer');

		}


		function getproduk(){
			$idkec = $this->input->get('idkec');
			$data['produk'] = $this->db->get_where('tbl_produk_seller', ['kec' => $idkec])->result_array();

			if ($data['produk'] == true) {
				$this->load->view('store/geproduk', $data);
			}else{
				$this->load->view('store/notproduk');
			}	
			
		}

		function detail_produk($id){

			$det = $this->db->get_where('tbl_produk_seller', ['id' => $id])->row_array();
			$data['produk'] = $this->db->get_where('tbl_produk_stok', ['id' => $det['id_produk']])->row_array();
			$data['seller'] = $this->db->get_where('tbl_seller', ['id' => $det['id_seller']])->row_array();
			$data['kode'] = "order-".rand(0, 10000);
			$data['id'] = $id;
			$data['listcart'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->result_array();
			$this->db->select_sum('total_harga');
			$data['totalharga'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->row_array();
			$this->load->view('template_store/header');
			$this->load->view('store/detail_produk', $data);
			$this->load->view('template_store/footer');
		} 

		function cart(){

			$kode_order = $this->input->get('kode');
			$id_produk = $this->input->get('id');
			$id_seller = $this->input->get('idseller');
			$qty = $this->input->get('qty');

			$cekorder = $this->db->get_where('tbl_cart_order', ['kode_order' => $kode_order])->row_array();
			if($cekorder == true){

				$data = [
					'qty' => $qty,
					'total_harga' => 130000 * $qty,
				];

				$this->db->where('kode_order', $kode_order);
				$this->db->update('tbl_cart_order', $data);
			}else{

				$produk = $this->db->get_where('tbl_produk_stok', ['id' => $id_produk])->row_array();
				$data = [
					'kode_order' => $kode_order,
					'id_produk' => $id_produk,
					'qty' => $qty,
					'nama_produk' => $produk['nama'],
					'berat' => $produk['berat'],
					'harga' => 130000,
					'total_harga' => 130000,
					'id_seller' => $id_seller,
					'kode_user' => $this->session->kode_user,

				];

				$this->db->insert('tbl_cart_order', $data);
			}

			$this->db->select_sum('total_harga');
			$data['totalharga'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->row_array();
			$data['cart'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->result_array();
			$this->load->view('store/getcart', $data);

		}


		function cartmin(){

			$kode_order = $this->input->get('kode');
			$qty = $this->input->get('qty');

			if ($qty == 0) {
				
				$this->db->where('kode_order', $kode_order);
				$this->db->delete('tbl_cart_order');

				$this->db->select_sum('total_harga');
				$data['totalharga'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->row_array();
				$data['cart'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->result_array();
				$this->load->view('store/getcartnot', $data);
			}else{

				$data = [
					'qty' => $qty,
					'total_harga' => 130000 * $qty
				];

				$this->db->where('kode_order', $kode_order);
				$this->db->update('tbl_cart_order', $data);

				$this->db->select_sum('total_harga');
				$data['totalharga'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->row_array();
				$data['cart'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->result_array();
				$this->load->view('store/getcart', $data);

			}

		}


		function act_login(){

			$wa = $this->input->post('wa');
			$password = $this->input->post('pass');
			$id = $this->input->post('id_produk');

			$cekwa = $this->db->get_where('tbl_register',['no_wa' => $wa])->row_array();
			if ($cekwa == true) {
				
				if (password_verify($password, $cekwa['pass'])) {
					
					$data = [
						'email' => $cekwa['email'],
						'name' => $cekwa['name'],
						'kode_user' => $cekwa['kode_user'],
					];
					$this->session->set_userdata($data);
					$this->session->set_flashdata('message', 'swal("Yess!", "Login sukses", "success" );');
					redirect('store/detail-produk/'.$id);
				}else{

					$this->session->set_flashdata('message', 'swal("Opps!", "password anda salah", "warning" );');
					redirect('store/detail-produk/'.$id);
				}	
				
			}
		}

		function hapuscart(){

			$id = $this->input->get('id');
			$this->db->where('id', $id);
			$this->db->delete('tbl_cart_order');
			
			$this->db->select_sum('total_harga');
			$data['totalharga'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->row_array();
			$data['cart'] = $this->db->get_where('tbl_cart_order', ['kode_user' => $this->session->kode_user])->result_array();
			$this->load->view('store/getcart', $data);

		}

		function add_order(){

			$kode_order = $this->input->post('kode_order[]');
			$id_produk = $this->input->post('id_produk[]');
			$id_seller = $this->input->post('id_seller[]');
			$qty = $this->input->post('qty[]');
			$harga = $this->input->post('harga[]');
			$total_harga = $this->input->post('total_harga[]');
			$berat = $this->input->post('berat[]');

			$langt = count($kode_order);
			$kode = 'order-'.rand(1, 10000);

			for ($i=0; $i < $langt ; $i++) { 
				
				$data = [
					'kode_order' => $kode,
					'kode_user' => $this->session->kode_user,
					'id_seller' => $id_seller[$i],
					'id_produk' => $id_produk[$i],
					'harga' => $harga[$i],
					'qty' => $qty[$i],
					'total_harga' => $total_harga[$i],
					'tgl_order' => date('Y-m-d'),
				];



				$this->db->insert('tbl_order', $data);

			}

			$this->session->set_flashdata('message', 'swal("Yess!", "Keranjang berhasil di tambah", "success" );');
			redirect("store/checkout/$kode");
		}


		function checkout($kode_order){

			$this->db->where('tgl_order', date('Y-m-d'));
			$this->db->where('kode_user', $this->session->kode_user);
			$data['order'] = $this->db->get('tbl_order')->result_array();
			$data['user'] = $this->db->get('tbl_register', ['kode_user' => $this->session->kode_user])->row_array();
			
			$kode_user = $this->session->kode_user;
			$data['alamat'] = $this->M_data->alamat_pengantaran($kode_user);

			$data['kab'] = $this->M_data->kab();

			$this->db->order_by('id', 'desc');
			$this->db->where('kode_user', $this->session->kode_user);
			$data['alamat'] = $this->db->get('tbl_alamat_pengantaran_user')->row_array();
			
			$data['getkab'] = $this->M_data->getkab($data['alamat']['kab']);
			$data['getkec'] = $this->M_data->getkec($data['alamat']['kec']);
			$data['getkel'] = $this->M_data->getkel($data['alamat']['kel']);

			$this->db->select_sum('total_harga');
			$data['subtotal'] = $this->db->get_where('tbl_order', ['kode_order' => $kode_order])->row_array();
			
			$data['kodeorder'] = $kode_order;

			$this->load->view('template/header');
			$this->load->view('store/checkout', $data);
			$this->load->view('template/footer');
		}


		function cart_update(){

			$id = $this->input->get('id');
			$qty = $this->input->get('qty');

			$order = $this->db->get_where('tbl_order', ['id' => $id])->row_array();

			$data = [
				'total_harga' => $order['harga'] * $qty,
				'qty' => $order['qty'] + 1,
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_order', $data);

			$order = $this->db->get_where('tbl_order', ['id' => $id])->row_array();
			echo $order['total_harga'];

		}

		function cart_update2(){

			$id = $this->input->get('id');
			$qty = $this->input->get('qty');

			$order = $this->db->get_where('tbl_order', ['id' => $id])->row_array();

			$data = [
				'total_harga' => $order['harga'] * $qty,
				'qty' => $qty,
			];

			$this->db->where('id', $id);
			$this->db->update('tbl_order', $data);

			$order = $this->db->get_where('tbl_order', ['id' => $id])->row_array();
			echo $order['total_harga'];

			

		}

		function total_pembayaran(){
			
			$id = $this->input->get('id');
			$harga = $this->db->get_where('tbl_order', ['id' => $id])->row_array();

			$this->db->select_sum('total_harga');
			$order = $this->db->get_where('tbl_order', ['id' => $id])->row_array();
			echo $order['total_harga'] + $harga['harga'];
		}


		function get_kec(){

			$id = $this->input->get('id');
			$data['kec'] = $this->db->get_where('tbl_kecamatan', ['regency_id' => $id])->result_array();
			$this->load->view('store/get_kec', $data);
		}


		function get_kel(){

			$id = $this->input->get('id');
			$data['kel'] = $this->db->get_where('tbl_kelurahan', ['district_id' => $id])->result_array();
			$this->load->view('store/get_kel', $data);
		}

		function hapus_cart_order($id){

			$this->db->where('id', $id);
			$this->db->delete('tbl_order');
			redirect('store/checkout/null');
		}



		function alamat_pengantaran(){

			$kodeorder = $this->input->post('kodeorder');
			$data = [

				'kode_user' => $this->session->kode_user,
				'kab' => $this->input->post('kab'),
				'kec' => $this->input->post('kec'),
				'kel' =>  $this->input->post('kel'),
				'alamat' => $this->input->post('alamat_lengkap'),
			];

			$this->db->insert('tbl_alamat_pengantaran_user', $data);
			$this->session->set_flashdata('message', 'swal("Yess!", "Alamat berhasil di tambah", "success" );');
			redirect("store/checkout/$kodeorder");
		}


		function checkout_order(){

			$kode_user = $this->session->kode_user;
			$pembayaran = $this->input->post('pembayaran[]');

			$this->db->order_by('id', 'desc');
			$this->db->where('kode_user', $kode_user);
			$order = $this->db->get('tbl_order')->row_array();
			$kode_order = $order['kode_order'];

			if ($pembayaran == null) {
				
				$this->session->set_flashdata('message', 'swal("Opps!", "pembayaran harus di isi", "error" );');
				redirect("store/checkout/$kode_order");
			}else{




				$this->db->select_sum('total_harga');
				$total_harga = $this->db->get_where('tbl_order', ['kode_order' => $order['kode_order']])->row_array();

				$this->db->order_by('id', 'desc');
				$alamat_pengantaran = $this->db->get_where('tbl_alamat_pengantaran_user', ['kode_user' => $kode_user])->row_array();

				$data = [
					'kode_order' => $order['kode_order'],
					'kode_user' => $kode_user,
					'kode_seller' => $order['id_seller'],
					'total_pembayaran' => $total_harga['total_harga'],
					'alamat_pengantaran' => $alamat_pengantaran['id'],
					'pembayaran' => $pembayaran[0],
					'tgl' => date('Y-m-d'),

				];

				$kode_order = $order['kode_order'];

				$cekorder = $this->db->get_where('tbl_checkout', ['kode_order' => $kode_order])->row_array();
				if ($cekorder == true) {
					
					$this->session->set_flashdata('message', 'swal("Opps!", "anda sudah checkout", "error" );');
					redirect("store/checkout/$kode_order");
				}else{

					$this->db->insert('tbl_checkout', $data);
					$this->session->set_flashdata('message', 'swal("Yess!", "checkout anda berhasil", "success" );');
					redirect("store/list-order/$kode_order");

				}

			}

		}

		function list_order($kode_order){

			$data['order'] = $this->db->get_where('tbl_order',['kode_order' => $kode_order])->result_array();
			$data['user'] = $this->db->get_where('tbl_register', ['kode_user' => $this->session->kode_user])->row_array();

			
			$data['ck'] = $this->db->get_where('tbl_checkout',['kode_order' => $kode_order])->row_array();
			$data['bukti'] = $this->db->get_where('tbl_bukti_pembayaran', ['kode_order' => $kode_order])->row_array();

			$this->load->view('template_store/header');
			$this->load->view('store/list_order', $data);
			$this->load->view('template_store/footer');
		}


		function upload_bukti(){

			$kode_seller = $this->input->post('kode_seller');
			$kode_user = $this->input->post('kode_user');
			$kode_order = $this->input->post('kode_order');

			$config['upload_path']          = './assets/bukti/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['min_size']             = 9000000;
			$config['remove_spaces']        = false;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('bukti')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', 'swal("Ops!!", "format gambar tidak sesuai", "warning" );');
				redirect("shop/pembayaran/$kode_order");

			}else{

				$cek_konfirmasi = $this->db->get_where('tbl_bukti_pembayaran',['kode_order' => $kode_order])->row_array();

				if ($cek_konfirmasi == true) {

					$this->session->set_flashdata('message', 'swal("Ops!", "konfirmasi pembayaran sudah pernah dilakukan", "error" );');
					redirect("shop/pembayaran/$kode_order");

				}

				$data = [

					'kode_user' => $this->session->kode_user,
					'kode_order' => $this->input->post('kode_order'),
					'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),
					'bank_pengirim' => $this->input->post('bank_pengirim'),
					'nama_rekening' => $this->input->post('nama_rekening'),
					'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran'),
					// 'pesan' => $this->input->post('pesan_tambahan'),
					'bukti_pembayaran' => $_FILES['bukti']['name'],
					'status' => 0,

				];

				$this->db->insert('tbl_bukti_pembayaran', $data);

				$this->db->where('kode_order', $this->input->post('kode_order'));
				$this->db->update('tbl_checkout', ['status_upload_pembayaran' => 1]);

				$kode_order =  $this->input->post('kode_order');

			}

			$this->session->set_flashdata('message', 'swal("Yess!", "data berhasil dikirim", "success" );');
			redirect("store/list_order/$kode_order");
		}


		function cartAdd($data){


		}


		function show(){

			$display = $this->cart->contents();
			echo count($display);
		}


	}
?>