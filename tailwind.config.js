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
          'thai-red':'#A61932', 
      },
     

    },
    plugins: [
      require('@tailwindcss/forms'),

    ],
  }
}

