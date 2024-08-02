<template>
    <form>
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input type="text" class="input-filter-l w-28"  placeholder="Price from" />
                <input type="text" class="input-filter-r w-28"  placeholder="Price to"/>
            </div>
            <div class="flex flex-nowrap items-center">
               <select class="input-filter-l w-22">
                 <option :value="null">Beds</option>
                 <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                 <option>6+</option>

               </select>
          
               <select class="input-filter-r w-22">
                 <option :value="null">Baths</option>
                 <option v-for="n in 5" :key="n" :value="n" v-text="n" />
                 <option>6+</option>

               </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input type="text" class="input-filter-l w-28" placeholder="Area from" />
                <input type="text" class="input-filter-r w-28" placeholder="Area to"/>
            </div>

            <button type="submit" class="btn-normal">Filters</button>
            <button type="reset">Clear</button>

        </div>
        
    </form>
</template>

<script setup> 
</script>