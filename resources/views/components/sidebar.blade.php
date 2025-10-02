<aside class="w-64 bg-gray-900 text-white min-h-screen px-4 py-6">
    <h2 class="text-xl font-bold mb-6">Dashboard</h2>
    <nav class="space-y-4">
        <a href="{{ url('/dashboard') }}" class="block hover:bg-gray-700 p-2 rounded">🏠 Home</a>
        <a href="{{ url('/profile') }}" class="block hover:bg-gray-700 p-2 rounded">👤 Profile</a>
      <a href="{{url('/brands')}}" class="block hover:bg-gray-700 p-2 rounded">Brands</a>
      <a href="" class="block hover:bg-gray-700 p-2 rounded">Products</a>
      <a href="" class="block hover:bg-gray-700 p-2 rounded">Products Categories</a>
       
        <a href="{{ url('/logout') }}" class="block hover:bg-red-700 p-2 rounded">🚪 Logout</a>
        
    </nav>
</aside>
