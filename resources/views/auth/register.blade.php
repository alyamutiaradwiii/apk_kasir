@extends('_template_auth.layout')
<title> Register </title>
@section('content')

	<!-- main-signin-wrapper -->
	<div class="my-auto page page-h">
		<div class="main-signin-wrapper">
			<div class="main-card-signin d-md-flex">
			<div class="wd-md-50p login d-none d-md-block page-signin-style p-5 text-white" >
				<div class="my-auto authentication-pages">
					<div>
						<img src="../assets/img/brand/buku.png" class=" m-0 mb-4" alt="logo">
						
						<h2 class="mb-5">Selamat Datang
							 </h2>
						<p class="mb-5">Untuk tetap terhubung dengan kami,
							silahkan Daftar akun terlebih dahulu!!
						</p>
					</div>
				</div>
			</div>
			<div class="sign-up-body wd-md-50p">
				<div class="main-signin-header">
					<center><h2>Welcome!</h2></center>
					<div class="px-0 col-12 mb-2">
                        {{-- @include('_component.message') --}}
                    </div>
					<center><h4>Please Register</h4></center>
					<form  action="{{ route('register')}}" method="POST">
						@csrf
						<div class="form-group">
							<label>Username</label>
							<input name="username" class="form-control" placeholder=" username"
								type="text" required  value="{{ old('username') }}">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input name="email" class="form-control" placeholder=" email"
								type="email" required value="{{ old('email') }}">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input name="password" class="form-control" placeholder=" password"
								type="text" required autofocus>
						</div>
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input name="namaLengkap" class="form-control" placeholder=" nama lengkap"
								type="text" required  value="{{ old('namaLengkap') }}">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input name="alamat" class="form-control" placeholder=" alamat"
								type="komentar"  value="{{ old('alamat') }}">
						</div>
						<div class="form-group">
							<label>Role</label>
							<select class="form-control" name="role" >
								<option value="">Pilih Hak Akses </option>
								<option value="administrator"> Administrator</option>
								<option value="petugas">Petugas</option>
							</select>
						</div>
						<div class="form-group">
							<label>verifikasi</label>
							<select class="form-control" name="verifikasi" >
								<option value="">Pilih</option>
								<option value="sudah">Sudah</option>
								<option value="belum">Belum</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary btn-block"><i class="fe fe-log-in"></i> Sign In</button>
					</form>
				</div>
				<div class="main-signup-footer mg-t-10">
					<p>Sudah Punya akun?<a href="{{ route('login') }}">  Login!</a></p>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- page closed -->
	
@endsection
	