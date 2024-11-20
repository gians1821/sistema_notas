<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\TipoPersonal;
use App\Models\Curso;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    const PAGINACION = 6;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $buscarporNombre = $request->get('buscarporNombre');
        $buscarporApellido = $request->get('buscarporApellido');
        $buscarporTipoPersonal = $request->get('buscarporTipoPersonal');

        // Consulta para buscar tanto por nombre como por apellido
        $personal = Personal::where('id_personal', '>', 0)
            ->where(function ($query) use ($buscarporNombre, $buscarporApellido, $buscarporTipoPersonal) {
                //FILTRAR POR NOMBRE
                if ($buscarporNombre) {
                    $query->where('nombre', 'like', '%' . $buscarporNombre . '%');
                }
                //FILTRAR POR APELLIDO
                if ($buscarporApellido) {
                    $query->where('apellido', 'like', '%' . $buscarporApellido . '%');
                }
                //FILTRAR POR TIPO DE PERSONAL
                if ($buscarporTipoPersonal) {
                    $query->whereHas('tipopersonal', function ($q) use ($buscarporTipoPersonal) {
                        $q->where('nombre_tipopersonal', 'like', '%' . $buscarporTipoPersonal . '%');
                    });
                }
            })
            ->paginate($this::PAGINACION);
        $personal->appends(['buscarporNombre' => $buscarporNombre, 'buscarporApellido' => $buscarporApellido, 'buscarporTipoPersonal' => $buscarporTipoPersonal]);

        return view('Personal.Personal', compact('personal', 'buscarporNombre', 'buscarporApellido', 'buscarporTipoPersonal'));
    }


    public function create()
    {
        return view('Personal.create');
    }

    public function store(Request $request)
    {
        // Validar datos del formulario
        $rules = [
            'dNI' => 'required|regex:/^\d+$/|max:8',
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellido' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'direccion' => 'required|regex:/^[\pL\s\.\-\'\"\d]+$/u|max:45',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|regex:/^\d+$/|max:11',
            'id_tipo_personal' => 'required|string|max:30',
        ];

        // Validación condicional
        if ($request->input('id_tipo_personal') === 'DOCENTE') {
            $rules['nivel'] = 'required|regex:/^[\pL\s]+$/u|max:30';
            $rules['grado'] = 'required|regex:/^[\pL\s]+$/u|max:30';
            $rules['curso'] = 'required|regex:/^[\p{L}\s.\/]+$/u|max:30';
        }

        $messages = [

            'dNI.required' => 'Ingrese el DNI del personal.',
            'dNI.regex' => 'El DNI del personal debe ser solo números.',
            'dNI.max' => 'El DNI del personal no debe exceder los 8 dígitos.',

            'nombre.required' => 'Ingrese el nombre del personal.',
            'nombre.regex' => 'El nombre del personal debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del personal no debe exceder los 30 caracteres.',

            'apellido.required' => 'Ingrese el apellido del personal.',
            'apellido.regex' => 'El apellido del personal debe ser una cadena de texto.',
            'apellido.max' => 'El apellido del personal no debe exceder los 30 caracteres.',

            'direccion.required' => 'Ingrese la direccion del personal.',
            'direccion.regex' => 'La direccion del personal puede incluir guiones, comillas y números.',
            'direccion.max' => 'La direccion del personal no debe exceder los 45 caracteres.',

            'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
            'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

            'telefono.required' => 'Ingrese el teléfono.',
            'telefono.regex' => 'El teléfono debe ser solo números.',
            'telefono.max' => 'El teléfono no debe exceder los 11 dígitos.',

            'id_tipo_personal.required' => 'Seleccione el tipo de personal.',
            'id_tipo_personal.max' => 'El tipo de personal no debe exceder los 30 caracteres.',

            'nivel.required' => 'Seleccione el nivel.',
            'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

            'grado.required' => 'Seleccione el grado.',
            'grado.max' => 'El grado no debe exceder los 15 caracteres.',

            'curso.required' => 'Seleccione el curso.',
            'curso.max' => 'El curso no debe exceder los 15 caracteres.',
        ];

        $data = $request->validate($rules, $messages);

        // Obtener el valor de sección desde el formulario y asignarlo
        $tipopersonal = $request->id_tipo_personal;
        $nivel = $request->nivel;
        $grado = $request->grado;
        $curso = $request->curso;
        $dni = $request->input('dNI');

        // Variable para almacenar el valor de id_seccion

        $id_grado = 0;
        $id_tipopersonal = 0;

        switch ($tipopersonal) {
            case 'DOCENTE':
                $id_tipopersonal = 1;
                break;
            case 'ADMINISTRADOR':
                $id_tipopersonal = 2;
                break;
            case 'DIRECTOR':
                $id_tipopersonal = 3;
                break;
            case 'ASISTENTE':
                $id_tipopersonal = 4;
                break;
                break;
        }

        // Lógica para asignar el valor de id_seccion basado en nivel, grado y sección
        switch ($nivel) {
            case 'PRIMARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 1;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 2;
                        break;
                    case 'TERCERO':
                        $id_grado = 3;
                        break;
                    case 'CUARTO':
                        $id_grado = 4;
                        break;
                    case 'QUINTO':
                        $id_grado = 5;
                        break;
                    case 'SEXTO':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'SECUNDARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 7;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 8;
                        break;
                    case 'TERCERO':
                        $id_grado = 9;
                        break;
                    case 'CUARTO':
                        $id_grado = 10;
                        break;
                    case 'QUINTO':
                        $id_grado = 11;
                        break;
                }
                break;
        }


        // Obtener el id_curso del curso que cumple con las condiciones
        $cursoEncontrado = Curso::where('grado_id_grado', $id_grado)
            ->whereRaw('LOWER(nombre_curso) = ?', [strtolower($curso)])
            ->pluck('id_curso') // Extrae solo el valor de 'id_curso'
            ->first();

        // Verificar si ya existe personal con el mismo DNI
        $existePersonaal = Personal::where('dNI', $dni)->first();
        if ($existePersonaal) {
            return redirect()->route('Personal.index')->with('datos', 'Ya existe personal con ese DNI');
        }

        // Verificar si el curso encontrado ya tiene personal asignado
        if ($cursoEncontrado !== null) {
            $existePersonal = Personal::where('curso_id_curso', $cursoEncontrado)->exists();
            if ($existePersonal) {
                return redirect()->route('Personal.index')->with('datos', 'Ya existe personal para este curso');
            }
        }
        $personal = new Personal();
        $personal->id_tipo_personal = $id_tipopersonal;
        $personal->dNI = $dni;
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->direccion = $request->direccion;
        $personal->fecha_nacimiento = $request->fecha_nacimiento;
        $personal->telefono = $request->telefono;
        $personal->curso_id_curso = $cursoEncontrado;
        $personal->save();
        return redirect()->route('Personal.index')->with('datos', 'Personal guardado exitosamente');
    }

    public function edit($id_personal)
    {
        $personal = Personal::findOrFail($id_personal);
        return view('Personal.edit', compact('personal'));
    }

    public function update(Request $request, $id_personal)
    {
        // Validar datos del formulario
        $rules = [
            'dNI' => 'required|regex:/^\d+$/|max:8',
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellido' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'direccion' => 'required|regex:/^[\pL\s\.\-\'\"\d]+$/u|max:45',
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'required|regex:/^\d+$/|max:11',
            'id_tipo_personal' => 'required|string|max:30',
        ];

        // Validación condicional
        if ($request->input('id_tipo_personal') === 'DOCENTE') {
            $rules['nivel'] = 'required|regex:/^[\pL\s]+$/u|max:30';
            $rules['grado'] = 'required|regex:/^[\pL\s]+$/u|max:30';
            $rules['curso'] = 'required|regex:/^[\p{L}\s.\/]+$/u|max:30';
        }

        $messages = [

            'dNI.required' => 'Ingrese el DNI del personal.',
            'dNI.regex' => 'El DNI del personal debe ser solo números.',
            'dNI.max' => 'El DNI del personal no debe exceder los 8 dígitos.',

            'nombre.required' => 'Ingrese el nombre del personal.',
            'nombre.regex' => 'El nombre del personal debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del personal no debe exceder los 30 caracteres.',

            'apellido.required' => 'Ingrese el apellido del personal.',
            'apellido.regex' => 'El apellido del personal debe ser una cadena de texto.',
            'apellido.max' => 'El apellido del personal no debe exceder los 30 caracteres.',

            'direccion.required' => 'Ingrese la direccion del personal.',
            'direccion.regex' => 'La direccion del personal puede incluir guiones, comillas y números.',
            'direccion.max' => 'La direccion del personal no debe exceder los 45 caracteres.',

            'fecha_nacimiento.required' => 'Ingrese la fecha de nacimiento.',
            'fecha_nacimiento.date' => 'Ingrese una fecha válida.',

            'telefono.required' => 'Ingrese el teléfono.',
            'telefono.regex' => 'El teléfono debe ser solo números.',
            'telefono.max' => 'El teléfono no debe exceder los 11 dígitos.',

            'id_tipo_personal.required' => 'Seleccione el tipo de personal.',
            'id_tipo_personal.max' => 'El tipo de personal no debe exceder los 30 caracteres.',

            'nivel.required' => 'Seleccione el nivel.',
            'nivel.max' => 'El nivel no debe exceder los 15 caracteres.',

            'grado.required' => 'Seleccione el grado.',
            'grado.max' => 'El grado no debe exceder los 15 caracteres.',

            'curso.required' => 'Seleccione el curso.',
            'curso.max' => 'El curso no debe exceder los 15 caracteres.',
        ];

        $data = $request->validate($rules, $messages);

        // Obtener el valor de sección desde el formulario y asignarlo
        $tipopersonal = $request->id_tipo_personal;
        $nivel = $request->nivel;
        $grado = $request->grado;
        $curso = $request->curso;
        // Variable para almacenar el valor de id_seccion

        $id_grado = 0;
        $id_tipopersonal = 0;

        switch ($tipopersonal) {
            case 'DOCENTE':
                $id_tipopersonal = 1;
                break;
            case 'ADMINISTRADOR':
                $id_tipopersonal = 2;
                break;
            case 'DIRECTOR':
                $id_tipopersonal = 3;
                break;
            case 'ASISTENTE':
                $id_tipopersonal = 4;
                break;
                break;
        }

        // Lógica para asignar el valor de id_seccion basado en nivel, grado y sección
        switch ($nivel) {
            case 'PRIMARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 1;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 2;
                        break;
                    case 'TERCERO':
                        $id_grado = 3;
                        break;
                    case 'CUARTO':
                        $id_grado = 4;
                        break;
                    case 'QUINTO':
                        $id_grado = 5;
                        break;
                    case 'SEXTO':
                        $id_grado = 6;
                        break;
                }
                break;
            case 'SECUNDARIA':
                switch ($grado) {
                    case 'PRIMERO':
                        $id_grado = 7;
                        break;
                    case 'SEGUNDO':
                        $id_grado = 8;
                        break;
                    case 'TERCERO':
                        $id_grado = 9;
                        break;
                    case 'CUARTO':
                        $id_grado = 10;
                        break;
                    case 'QUINTO':
                        $id_grado = 11;
                        break;
                }
                break;
        }

        // Obtener el id_curso del curso que cumple con las condiciones
        $cursoEncontrado = Curso::where('grado_id_grado', $id_grado)
            ->whereRaw('LOWER(nombre_curso) = ?', [strtolower($curso)])
            ->pluck('id_curso') // Extrae solo el valor de 'id_curso'
            ->first();

        // Verificar si el curso encontrado ya tiene personal asignado
        if ($cursoEncontrado !== null) {
            $existePersonal = Personal::where('curso_id_curso', $cursoEncontrado)->exists();
            if ($existePersonal) {
                return redirect()->route('Personal.index')->with('datos', 'Ya existe personal para este curso');
            }
        }


        $personal = Personal::findOrFail($id_personal);
        $personal->id_tipo_personal = $id_tipopersonal;
        $personal->dNI = $request->dNI;
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->direccion = $request->direccion;
        $personal->fecha_nacimiento = $request->fecha_nacimiento;
        $personal->telefono = $request->telefono;
        $personal->curso_id_curso = $cursoEncontrado;
        $personal->save();
        return redirect()->route('Personal.index')->with('datos', 'Registro Guardado..!');
    }
    public function show(string $id)
    {
        //
    }
    public function confirmar($id_personal)
    {
        $personal = Personal::findOrFail($id_personal);
        return view('Personal.confirmar', compact('personal'));
    }

    public function destroy($id_personal)
    {
        $personal = Personal::findOrFail($id_personal);
        $personal->delete();
        return redirect()->route('Personal.index')->with('datos', 'Registro Eliminado..');
    }
}