const formNotas = document.forms['borrarNotasForm'];
const modalNotas = document.getElementById('borrarModalNotas');

const borrarNota = (materia, estudiante) => {
    formNotas['materia'].value = materia;
    formNotas['estudiante'].value = estudiante;
    modalNotas.classList.add('show');
};

formNotas.addEventListener('reset', () => {
    formNotas['materia'].value = '';
    formNotas['estudiante'].value = '';
    modalNotas.classList.remove('show');
});
////
const formEstudiantes = document.forms['borrarEstudiantesForm'];
const modalEstudiantes = document.getElementById('borrarModalEstudiantes');

const borrarEstudiante = (codigo) => {
    formEstudiantes['codigo'].value = codigo;
    modalEstudiantes.classList.add('show');
};

formEstudiantes.addEventListener('reset', () => {
    formEstudiantes['codigo'].value = '';
    modalEstudiantes.classList.remove('show');
});
////
const formMaterias = document.forms['borrarMateriasForm'];
const modalMaterias = document.getElementById('borrarModalMaterias');

const borrarMateria = (codigo) => {
    formMaterias['codigo'].value = codigo;
    modalMaterias.classList.add('show');
};

formMaterias.addEventListener('reset', () => {
    formMaterias['codigo'].value = '';
    modalMaterias.classList.remove('show');
});

//
const formProgramas = document.forms['borrarProgramasForm'];
const modalProgramas = document.getElementById('borrarModalProgramas');

const borrarPrograma = (codigo) => {
    formProgramas['codigo'].value = codigo;
    modalProgramas.classList.add('show');
};

formProgramas.addEventListener('reset', () => {
    formProgramas['codigo'].value = '';
    modalProgramas.classList.remove('show');
});

