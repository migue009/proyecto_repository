<div class="container card">
  <div class="row">
    <div class="mt-4">
      <h3 class="text-center">Geovisor APPorte</h3>
    </div>
    <div class="row stat-cards">
      <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
          <div class="stat-cards-icon primary">
            <i data-feather="bar-chart-2" aria-hidden="true"></i>
          </div>
          <div class="stat-cards-info">
            <p class="stat-cards-info__num">10</p>
            <p class="stat-cards-info__title">Vias en mal estado</p>
            <p class="stat-cards-info__progress">
              <span class="stat-cards-info__profit success">
                <i data-feather="trending-up" aria-hidden="true"></i>1
              </span>
              Ultimo mes
            </p>
          </div>
        </article>
      </div>
      <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
          <div class="stat-cards-icon warning">
            <i data-feather="file" aria-hidden="true"></i>
          </div>
          <div class="stat-cards-info">
            <p class="stat-cards-info__num">10</p>
            <p class="stat-cards-info__title">Reportes de accidente</p>
            <p class="stat-cards-info__progress">
              <span class="stat-cards-info__profit success">
                <i data-feather="trending-up" aria-hidden="true"></i>2
              </span>
              Ultimo mes
            </p>
          </div>
        </article>
      </div>
      <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
          <div class="stat-cards-icon purple">
            <i data-feather="file" aria-hidden="true"></i>
          </div>
          <div class="stat-cards-info">
            <p class="stat-cards-info__num">20</p>
            <p class="stat-cards-info__title">Señales en mal estado</p>
            <p class="stat-cards-info__progress">
              <span class="stat-cards-info__profit danger">
                <i data-feather="trending-down" aria-hidden="true"></i>1
              </span>
              Ultimo mes
            </p>
          </div>
        </article>
      </div>
      <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
          <div class="stat-cards-icon success">
            <i data-feather="feather" aria-hidden="true"></i>
          </div>
          <div class="stat-cards-info">
            <p class="stat-cards-info__num">19</p>
            <p class="stat-cards-info__title">Reductores en mal estado</p>
            <p class="stat-cards-info__progress">
              <span class="stat-cards-info__profit warning">
                <i data-feather="trending-up" aria-hidden="true"></i>2
              </span>
              Ultimo mes
            </p>
          </div>
        </article>
      </div>
    </div>
    
    <?php include_once 'mapa.php'; ?>
    
    <!-- Video debajo del mapa -->
    <div class="row mt-4">
      <div class="col-12">
        <h3>Video de presentación</h3>
        <div class="video-container">
          <video width="100%" controls>
            <source src="../img/videoprueba.mp4" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>
</div>
