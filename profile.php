 <?php 
  include_once 'db/session.php';
 include_once 'db/connect.php';
 include_once 'db/function.php';
 include_once 'navbar.php';
 



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF8">
		<title>FlexBox</title>
		<link rel="stylesheet" href="css/navbar.css">
		<link rel="stylesheet" href="css/profile.css">
	</head>
	<body>
	<?php 
	if($user_id != ''){
		}?>


				
<?php  if($user_id != ''){
       $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?
	   LIMIT  1");
	   $select_profile->execute([$user_id]);
	   if($select_profile->rowCount() > 0){
		$fetch_profile = $select_profile->fetch(PDO:: FETCH_ASSOC);
	   }

}








?>
<?php 

$select_main = $conn->prepare("SELECT * FROM `mains`");
$select_main->execute();
$fetch_main = $select_main->fetch(PDO::FETCH_ASSOC);

?>
	
	<div class="banner">
	<img src="image/<?=  $fetch_profile['image']; ?>"   alt="banner">
	
		</div>

		<div class="bar">
			<div class="content">
				<ul>
					<li class="active">
						<span>Tweets</span>
						<strong>3540</strong>
					</li>
					<li>
						<span>Followings</span>
						<strong>100</strong>
					</li>
					<li>
						<span>Followers</span>
						<strong>1210</strong>
					</li>
					<li>
						<span>Favorites</span>
						<strong>98</strong>
					</li>
				</ul>
				<div class="actions">
			<a href="update.php"><button>update profile</button></a>
				<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>                                                                                                                                    
					<input type="text" placeholder="search on twitter"/>
				</div>
			</div>
		</div>

		<div class="wrapper-content content">
		

				<div class="widget followers">
					<strong><img src="/images/person.svg" alt="followers"> *</strong>
					<ul>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>

				
			</aside>

			<section class="timeline">
				<nav>
					<a href="/" class="active"><?= $fetch_profile['username']; ?></a>
					<a href="session.php">create session</a>
					<a href="/">Media</a>
				</nav>
				<ul class="tweets">
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong><?= $fetch_profile['username']; ?> <span></span></strong>
							<p> <?= $fetch_main['about'];?></p>
							<div class="actions">
								<a href="/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg></a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<?php 
						$verify_main = $conn->prepare("SELECT * FROM `mains` WHERE user_id = ?");
						$verify_main->execute([$user_id]);
						if($verify_main->rowCount() < 0){
							$success_msg = 'create a session';
						}else{

						
						?>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong><?= $fetch_profile['username']; ?>  <span><?= $fetch_main['nickname']; ?></span></strong>
							<p><?= $fetch_main['about'];?></p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<?php }; ?>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p> Hoje eu aprendi a dominar a terra com a toph. Otima professora apesar de cega</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p> Estamos viajando com meu bisao voador uhullll, que saudades que eu tava</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p> Estamos viajando com meu bisao voador uhullll, que saudades que eu tava</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p>Galera a tribo da agua do sul e muito legal tem otimos dominadores de agua</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p> Estamos viajando com meu bisao voador uhullll, que saudades que eu tava</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
					<li>
						<img src="/images/avatar.png" alt="">
						<div class="info">
							<strong>Avatar Aang <span>@aang</span></strong>
							<p> Cara acabei de acordar depois de 100 anos gracas a @sOkKa e a @katara</p>
							<div class="actions">
								<a href="/"><img src="/images/chat.svg" alt="chat">3</a>
								<a href="/"><img src="/images/favorite.svg" alt="favorite">4</a>
							</div>
						</div>
					</li>
				</ul>
			</section>

			<aside class="widgets">
				<div class="widget follow">
					<div class="title">
						<strong>Who to follow</strong>
						<a href="/">Refresh</a>
						<a href="/">View all</a>
					</div>

					<ul>
						<li>
							<div class="profile">
								<img src="/images/katara.png" alt="avatar">
								<div class="info">
									<strong>Katara <span>@katara</span></strong>
									<button>Follow</button>
								</div>
							</div>
							<a href="/">x</a>
						</li>
						<li>
							<div class="profile">
								<img src="/images/zuko.png" alt="avatar">
								<div class="info">
									<strong>Zuko <span>@zuko</span></strong>
									<button>Follow</button>
								</div>
							</div>
							<a href="/">x</a>
						</li>
						<li>
							<div class="profile">
								<img src="/images/sokka.png" alt="avatar">
								<div class="info">
									<strong>Sokka <span>@sOkKa</span></strong>
									<button>Follow</button>
								</div>
							</div>
							<a href="/">x</a>
						</li>
					</ul>
				</div>
			</aside>
		</div>
	</body>
</html>