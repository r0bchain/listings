/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    // "./resources/js/**/{vue,js,ts,jsx,tsx}",
    "./resources/js/**/*.vue",

    ],
    theme: {
      extend: {
        colors:{
          'primary':'#FF6363',
          'secondary':{
            100:'#E2E2D5',
            200:'#888883'
          },
          'thai-blue':'#3A599A',
          'thai-blue-dark': '#111827',
          'thai-red':'#820f22', 
          'black-title': '#151515',
          'black-description' : '#686868',
      },
     

    },
    plugins: [
      require('@tailwindcss/forms'),
      require('tailwindcss-debug-screens'),


    ],
  }
}

