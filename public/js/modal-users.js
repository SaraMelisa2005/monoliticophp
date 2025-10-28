// Para notas
const formNotas = document.forms['borrarNotasForm'];
const modalNotas = document.getElementById('borrarModalNotas');

const borrarNota = (materia, estudiante) => {
    if (formNotas) {
        formNotas['materia'].value = materia;
        formNotas['estudiante'].value = estudiante;
        modalNotas.classList.add('show');
    }
};

if (formNotas) {  
    formNotas.addEventListener('reset', () => {
        formNotas['materia'].value = '';
        formNotas['estudiante'].value = '';
        modalNotas.classList.remove('show');
    });
}

// Para estudiantes
const formEstudiantes = document.forms['borrarEstudiantesForm'];
const modalEstudiantes = document.getElementById('borrarModalEstudiantes');

const borrarEstudiante = (codigo) => {
    if (formEstudiantes) {
        formEstudiantes['codigo'].value = codigo;
        modalEstudiantes.classList.add('show');
    }
};

if (formEstudiantes) {
    formEstudiantes.addEventListener('reset', () => {
        formEstudiantes['codigo'].value = '';
        modalEstudiantes.classList.remove('show');
    });
}

// Para materias
const formMaterias = document.forms['borrarMateriasForm'];
const modalMaterias = document.getElementById('borrarModalMaterias');

const borrarMateria = (codigo) => {
    if (formMaterias) {
        formMaterias['codigo'].value = codigo;
        modalMaterias.classList.add('show');
    }
};

if (formMaterias) {
    formMaterias.addEventListener('reset', () => {
        formMaterias['codigo'].value = '';
        modalMaterias.classList.remove('show');
    });
}



// Para programas
const formProgramas = document.forms['borrarProgramasForm'];
const modalProgramas = document.getElementById('borrarModalProgramas');

const borrarPrograma = (codigo) => {
    if (formProgramas) {
        formProgramas['codigo'].value = codigo;
        modalProgramas.classList.add('show');
    }
};

if (formProgramas) {
    formProgramas.addEventListener('reset', () => {
        formProgramas['codigo'].value = '';
        modalProgramas.classList.remove('show');
    });
}

