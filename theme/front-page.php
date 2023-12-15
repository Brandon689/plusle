<?php get_header(); ?>

<!-- <div class="bg-secondary text-center py-10">
    <h1 class="text-4xl font-bold">Your Banner Heading</h1>
    <p class="mt-4 text-lg">Your banner subheading or content goes here.</p>
</div> -->

<main class="container p-0 mx-auto mb-32">
  <div class="carousel w-full">
    <div id="slide1" class="carousel-item relative w-full">
      <img src="https://prod-out-res.popmart.com/cms/20231204_190921_4c21f6c199.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
        <a href="#slide4" class="btn btn-circle">❮</a>
        <a href="#slide2" class="btn btn-circle">❯</a>
      </div>
    </div>
    <div id="slide2" class="carousel-item relative w-full">
      <img src="https://prod-out-res.popmart.com/cms/pc_buy_now_e9eb8d160d.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
        <a href="#slide1" class="btn btn-circle">❮</a>
        <a href="#slide3" class="btn btn-circle">❯</a>
      </div>
    </div>
    <div id="slide3" class="carousel-item relative w-full">
      <img src="https://prod-out-res.popmart.com/cms/pc_buy_now_1_d48c6ecf57.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
        <a href="#slide2" class="btn btn-circle">❮</a>
        <a href="#slide4" class="btn btn-circle">❯</a>
      </div>
    </div>
    <div id="slide4" class="carousel-item relative w-full">
      <img src="https://prod-out-res.popmart.com/cms/pc_buy_now_1_94419a219c.jpg" class="w-full" />
      <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
        <a href="#slide3" class="btn btn-circle">❮</a>
        <a href="#slide1" class="btn btn-circle">❯</a>
      </div>
    </div>
  </div>


  <section aria-labelledby="category-heading">
    <div class="mx-auto py-24 sm:py-32">
      <div class="sm:flex sm:items-baseline sm:justify-between">
        <h2 id="category-heading" class="text-2xl font-bold tracking-tight text-gray-900 mx-auto">Shop by Category</h2>
      </div>

      <div class="mt-6 grid grid-cols-4 gap-y-6 sm:grid-cols-4 sm:grid-rows-2 sm:gap-x-6 lg:gap-4">

        <div class="group aspect-h-1 aspect-w-2 overflow-hidden col-span-2 sm:aspect-h-1 sm:aspect-w-1 sm:row-span-2">
          <img src="https://prod-out-res.popmart.com/cms/20231127_161944_6bf7e4d0f3.jpg" class="object-cover object-center group-hover:opacity-75">
        </div>
        <div class="group aspect-h-1 aspect-w-2 overflow-hidden col-span-2 sm:aspect-none sm:relative sm:h-full">
          <img src="https://prod-out-res.popmart.com/cms/2_4e6e51bd19.jpg" class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
        </div>
        <div class="group aspect-h-1 aspect-w-2 overflow-hidden sm:aspect-none sm:relative sm:h-full">
          <img src="https://prod-out-res.popmart.com/cms/3_9e5dd5e531.jpg" class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
        </div>

        <div class="group aspect-h-1 aspect-w-2 overflow-hidden sm:aspect-none sm:relative sm:h-full">
          <img src="https://prod-out-res.popmart.com/cms/4_67a72b310a.jpg" class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
        </div>

      </div>
    </div>
  </section>

  <?php
  ProductGrid(12, 'DATE', 'desc');
  ?>

</main>



<?php get_footer();