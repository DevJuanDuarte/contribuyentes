<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Editar Contribuyente') }}
      </h2>
  </x-slot>

  <div class="m-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <form class="max-w-xl mx-auto" method="POST" action="{{ route('contribuyentes.update', $contribuyente->id) }}"
              x-data="{ 
                  tipoDocumento: '{{ $contribuyente->tipo_documento }}',
                  razonSocial: '{{ $contribuyente->nombres }} {{ $contribuyente->apellidos }}',
                  showRazonSocial: '{{ $contribuyente->tipo_documento }}' === 'NIT'
              }"
              x-init="$watch('tipoDocumento', value => {
                  showRazonSocial = value === 'NIT';
                  if (!showRazonSocial) {
                      razonSocial = '';
                  }
              })">
              @csrf
              @method('PUT')

              {{-- Tipo de documento --}}
              <div class="relative z-0 w-full mb-5 group">
                  <label for="tipo_documento" class="block mb-2 text-sm font-medium text-gray-500">Tipo de Documento</label>
                  <select id="tipo_documento" name="tipo_documento" x-model="tipoDocumento"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      <option class="text-gray-500 font-medium text-sm" value="CC">CC</option>
                      <option class="text-gray-500 font-medium text-sm" value="NIT">NIT</option>
                  </select>
              </div>

              {{-- Documento --}}
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="documento" id="documento" value="{{ $contribuyente->documento }}"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="documento" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Documento</label>
              </div>

              {{-- Razón Social (visible solo cuando tipo documento es NIT) --}}
              <template x-if="showRazonSocial">
                  <div class="relative z-0 w-full mb-5 group">
                      <input type="text" x-model="razonSocial" name="razon_social"
                          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                          placeholder=" " required />
                      <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Razón Social</label>

                      {{-- Campos ocultos para nombres y apellidos cuando es NIT --}}
                      <input type="hidden" name="nombres" x-bind:value="razonSocial.split(' ').slice(0, -1).join(' ')" />
                      <input type="hidden" name="apellidos" x-bind:value="razonSocial.split(' ').slice(-1)[0]" />
                  </div>
              </template>

              {{-- Nombres y Apellidos (visibles solo cuando tipo documento NO es NIT) --}}
              <template x-if="!showRazonSocial">
                  <div>
                      {{-- Nombres --}}
                      <div class="relative z-0 w-full mb-5 group">
                          <input type="text" name="nombres" id="nombres" value="{{ $contribuyente->nombres }}"
                              class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                              placeholder=" " required />
                          <label for="nombres" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres</label>
                      </div>

                      {{-- Apellidos --}}
                      <div class="relative z-0 w-full mb-5 group">
                          <input type="text" name="apellidos" id="apellidos" value="{{ $contribuyente->apellidos }}"
                              class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                              placeholder=" " required />
                          <label for="apellidos" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>
                      </div>
                  </div>
              </template>

              {{-- Dirección --}}
              <div class="relative z-0 w-full mb-5 group">
                  <input type="text" name="direccion" id="direccion" value="{{ $contribuyente->direccion }}"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="direccion"
                      class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Dirección</label>
              </div>

              <div class="grid md:grid-cols-2 md:gap-6">
                  <div class="relative z-0 w-full mt-0 md:mt-5 mb-5 group">
                      <input type="text" name="telefono" id="telefono" value="{{ $contribuyente->telefono }}"
                          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                          placeholder=" " required />
                      <label for="telefono"
                          class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Teléfono</label>
                  </div>

                  <div class="relative z-0 w-full mt-0 md:mt-5 mb-5 group">
                      <input type="text" name="celular" id="celular" value="{{ $contribuyente->celular }}"
                          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                          placeholder=" " required />
                      <label for="celular"
                          class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Celular</label>
                  </div>
              </div>

              <div class="relative z-0 w-full mb-5 group">
                  <input type="email" name="email" id="email" value="{{ $contribuyente->email }}"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" " required />
                  <label for="email"
                      class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
              </div>

              {{-- Botón --}}
              {{-- <div class="flex justify-center">
                  <button type="submit"
                      class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar
                      Contribuyente</button>
              </div> --}}
              <div class="flex justify-between">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Actualizar Contribuyente
                </button>

                <a href="{{ route('contribuyentes.index') }}"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Cancelar
                </a>
            </div>
          </form>
      </div>
  </div>
</x-app-layout>
