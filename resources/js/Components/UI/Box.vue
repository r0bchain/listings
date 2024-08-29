<template>
    <!-- <div class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300 overflow-hidden rounded-lg shadow transition hover:shadow-lg">
      <div class="text-gray-500 font-medium mb-1">
        <slot name="header" />
      </div>
      <slot />
    </div> -->

  <article class="overflow-hidden  shadow transition hover:shadow-lg">
  
    <slot name="image" />
    <div class="bg-white p-4 sm:p-6">

      <a href="#">
        <h3 class="mt-0.5 text-lg text-gray-900"><slot name="header" /></h3>
      </a>

      <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
        <slot />
      </p>
    </div>
  </article>

</template>


