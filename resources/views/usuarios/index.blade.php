<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center md:justify-start">
                <a class="focus:outline-none my-4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                    href="{{ route('usuarios.create') }}">Crear Usuario</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{
                    usuarios: @js($usuarios->items()),
                    search: {
                        nombre: '',
                        email: ''
                    },
                    get filteredUsuarios() {
                        return this.usuarios.filter(usuario => {
                            return (
                                usuario.name.toLowerCase().includes(this.search.nombre.toLowerCase()) &&
                                usuario.email.toLowerCase().includes(this.search.email.toLowerCase())
                            )
                        })
                    }
                }">
                    <div class="mb-4">
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                        <input type="text" x-model="search.nombre"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            placeholder="Buscar...">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                      Email
                                      <input type="text" x-model="search.email"
                                          class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                          placeholder="Buscar...">
                                  </th>
                                    <th scope="col" class="px-6 py-3">Rol</th>
                                    <th scope="col" class="px-6 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="usuario in filteredUsuarios" :key="usuario.id">
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4" x-text="usuario.name"></td>
                                        <td class="px-6 py-4" x-text="usuario.email"></td>
                                        <td class="px-6 py-4" x-text="usuario.roles[0]?.name ?? 'Sin rol'"></td>
                                        @role('superadmin')
                                            <td class="px-6 py-4 h-full">
                                                <div class="flex items-center justify-center">
                                                    <a :href="`/usuarios/${usuario.id}/edit`"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                                    <form :action="`/usuarios/${usuario.id}`" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endrole
                                    </tr>
                                </template>
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $usuarios->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
