<section>
  <div class="box-breadcrumb-cover" style="background-image: url({{ isset($background) ? $background : ''; }});">
    <div class="container">
      <nav class="nav-breadcrumb" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ isset($title) ? $title : ''; }}</li>
        </ol>
      </nav>
      <h2>{{ isset($description) ? $description : ''; }}</h2>
      @php
        if(isset($author) && isset($date_create)){
          echo '<p>' . $author . ' ' .  $date_create . '</p>';
        }
      @endphp
    </div>
  </div>
</section>
