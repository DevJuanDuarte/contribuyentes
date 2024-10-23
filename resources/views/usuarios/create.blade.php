<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Crear Usuario') }}
      </h2>
  </x-slot>

  <div class="py-12 m-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <form class="max-w-xl mx-auto" method="POST" action="#">
              @csrf
              @method('POST')
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="nombre" id="nombre"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="nombre"
                      class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="descripcion" id="descripcion"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="descripcion"
                      class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripcion</label>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                  <input type="number" name="precio" id="precio"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="precio"
                      class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Precio</label>
              </div>
              <div class="grid md:grid-cols-2 md:gap-6">
                  <div class="relative z-0 w-full mt-0 md:mt-5 mb-5 group">
                      <input type="number" name="cantidad" id="cantidad"
                          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                          placeholder=" " required />
                      <label for="cantidad"
                          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cantidad</label>
                  </div>
                  <div class="relative z-0 w-full mb-5 group">
                      <label for="categorias"
                          class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Seleccione una
                          categoria</label>
                      <select id="categoria" name="categoria"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                          <option class="text-gray-500 dark:text-gray-400 font-medium text-sm" value="Empanadas">
                              Empanadas</option>
                          <option class="text-gray-500 dark:text-gray-400 font-medium text-sm" value="Bebidas">Bebidas
                          </option>
                          <option class="text-gray-500 dark:text-gray-400 font-medium text-sm" value="Papas">Papas
                          </option>
                          <option class="text-gray-500 dark:text-gray-400 font-medium text-sm" value="Frutas">Frutas
                          </option>
                      </select>
                  </div>
              </div>
              <button type="submit"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
                  Producto</button>
          </form>

      </div>
  </div>
</x-app-layout>
