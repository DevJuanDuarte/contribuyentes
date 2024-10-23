<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contribuyentes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center md:justify-start">
                <a class="focus:outline-none my-4 text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                    href="{{ route('contribuyentes.create') }}">Crear Contribuyente</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-center rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombres
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Apellidos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Telefono
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contribuyentes as $contribuyente)
                                    <tr class="bg-white border-b text-center">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $contribuyente->tipo_documento }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $contribuyente->documento }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $contribuyente->nombres }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $contribuyente->apellidos }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $contribuyente->telefono }}
                                        </td>
                                        <td class="px-6 py-4 h-full flex justify-content-between">
                                            <!-- Añadimos 'h-full' para que la celda ocupe toda la altura -->
                                            <form action="{{ route('contribuyentes.destroy', $contribuyente->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex items-center">
                                                    <!-- Asegúrate de mantener 'items-center' aquí -->
                                                    <a href="{{ route('contribuyentes.edit', $contribuyente->id) }}"
                                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar</a>
                                                    <button type="submit"
                                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
