<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contribuyentes') }}
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center md:justify-start">
                <a class="focus:outline-none my-4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900" href="{{ route('contribuyentes.create') }}">Crear Contribuyente</a>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto" x-data="{
                        contribuyentes: {{ Js::from($contribuyentes->items()) }},
                        search: {
                            tipo_documento: '',
                            documento: '',
                            nombres: '',
                            apellidos: '',
                            telefono: ''
                        },
                        get filteredContribuyentes() {
                            return this.contribuyentes.filter(item => {
                                return (
                                    item.tipo_documento.toLowerCase().includes(this.search.tipo_documento.toLowerCase()) &&
                                    item.documento.toLowerCase().includes(this.search.documento.toLowerCase()) &&
                                    item.nombres.toLowerCase().includes(this.search.nombres.toLowerCase()) &&
                                    item.apellidos.toLowerCase().includes(this.search.apellidos.toLowerCase()) &&
                                    item.telefono.toLowerCase().includes(this.search.telefono.toLowerCase())
                                )
                            })
                        }
                    }">
                        <table class="w-full text-sm text-center rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo Documento
                                        <input 
                                            type="text" 
                                            x-model="search.tipo_documento"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            placeholder="Buscar...">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Documento
                                        <input 
                                            type="text" 
                                            x-model="search.documento"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            placeholder="Buscar...">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombres
                                        <input 
                                            type="text" 
                                            x-model="search.nombres"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            placeholder="Buscar...">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Apellidos
                                        <input 
                                            type="text" 
                                            x-model="search.apellidos"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            placeholder="Buscar...">
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Teléfono
                                        <input 
                                            type="text" 
                                            x-model="search.telefono"
                                            class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            placeholder="Buscar...">
                                    </th>
                                    @role('superadmin')
                                        <th scope="col" class="px-6 py-3">
                                            Acciones
                                        </th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="contribuyente in filteredContribuyentes" :key="contribuyente.id">
                                    <tr class="bg-white border-b text-center">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" x-text="contribuyente.tipo_documento"></td>
                                        <td class="px-6 py-4" x-text="contribuyente.documento"></td>
                                        <td class="px-6 py-4" x-text="contribuyente.nombres"></td>
                                        <td class="px-6 py-4" x-text="contribuyente.apellidos"></td>
                                        <td class="px-6 py-4" x-text="contribuyente.telefono"></td>
                                        @role('superadmin')
                                            <td class="px-6 py-4 h-full">
                                                <div class="flex items-center justify-center">
                                                    <a :href="`/contribuyentes/${contribuyente.id}/edit`" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                                    <form :action="`/contribuyentes/${contribuyente.id}`" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endrole
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 bg-white">
                        {{ $contribuyentes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>