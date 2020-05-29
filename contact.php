<?php include 'header.php';?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-end">
			<div class="col-md-9 ftco-animate pb-5">
				<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Inicio <i class="fa fa-chevron-right"></i></a></span> <span>Contacto <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">Contactos</h1>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="wrapper">
					<div class="row mb-5">
						<div class="col-md-3">
							<div class="dbox w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-map-marker"></span>
								</div>
								<div class="text">
									<p><span>Direccion:</span> Av Siglo XXI #404</p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="dbox w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-phone"></span>
								</div>
								<div class="text">
									<p><span>Telefono:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="dbox w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-paper-plane"></span>
								</div>
								<div class="text">
									<p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="dbox w-100 text-center">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-globe"></span>
								</div>
								<div class="text">
									<p><span>Website</span> <a href="#">yoursite.com</a></p>
								</div>
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-7">
							<div class="contact-wrap w-100 p-md-5 p-4">
								<h3 class="mb-4">Contactanos!</h3>
								<div id="form-message-warning" class="mb-4"></div>
								<div id="form-message-success" class="mb-4">
									Si quieres formar parte de este gran equipo solo tienes que llenar este formulario
								</div>
								<form method="POST" id="contactForm" name="contactForm" class="contactForm">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="name">Nombre Completo</label>
												<input type="text" class="form-control" name="name" id="name" placeholder="Nombre">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="label" for="email">Email</label>
												<input type="email" class="form-control" name="email" id="email" placeholder="Email">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="subject">Asunto</label>
												<input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label class="label" for="#">Mensaje</label>
												<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Mensaje"></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" value="Enviar Mensaje" class="btn btn-primary">
												<div class="submitting"></div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-5 d-flex align-items-stretch">
							<div class="info-wrap w-100 p-5 img" style="background-image: url(images/about.jpg);">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div id="map" class="map"></div>
			</div>
		</div>
	</div>
</section>
<?php include 'footer.php';?>