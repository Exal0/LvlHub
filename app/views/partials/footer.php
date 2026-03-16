<footer class="rounded-lg shadow m-4 bg-white dark:bg-gray-800 flex flex-col mt-auto">
    <div class="container mx-auto p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
            &copy; <?= date('Y') ?>LvLHub tous drois réservé
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">About</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Contact</a>
            </li>
        </ul>
    </div>


</footer>
   <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          'neon-blue': '#00f2ff',
          'neon-pink': '#ff00ff',
          'neon-green': '#39ff14',
        },
        boxShadow: {
          'glow-blue': '0 0 10px #00f2ff, 0 0 20px #00f2ff',
        }
      }
    }
  }
</script>