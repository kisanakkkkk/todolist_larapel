import { TodolistResponse } from './interfaces/response';
import { HTTP, loadingModal } from './app';
import { Modal } from 'bootstrap';
import TextEditor from './ckeditor';

const getTodolist = () => {
    HTTP.get<TodolistResponse[]>('/todolist/').then(res => {
        let table = document.querySelector('#todolist-table');
        table.querySelector('tbody').innerHTML = "";

        res.data.forEach((todo, idx) => {
            let el = <HTMLElement>document.querySelector<HTMLTemplateElement>('#row-template').content.cloneNode(true);

            el.querySelector('tr').classList.toggle('done', todo.is_done);

            if (todo.is_done) el.querySelector<HTMLButtonElement>('.iDone').style.display = 'none';
            else el.querySelector<HTMLButtonElement>('.iNotDone').style.display = 'none';

            el.querySelector('.iNo').textContent = (idx + 1).toString();
            el.querySelector('.iTitle').textContent = todo.title;
            el.querySelector('.iContent').textContent = todo.content;

            el.querySelector('.iUpdate').addEventListener('click', _ => { updateTodoList(todo); });
            el.querySelector('.iDelete').addEventListener('click', _ => { deleteTodoList(todo); });
            el.querySelector('.iNotDone').addEventListener('click', _ => { toggleTodoList(todo); });
            el.querySelector('.iDone').addEventListener('click', _ => { toggleTodoList(todo); });

            table.querySelector('tbody').appendChild(el);
        });
    });
}

getTodolist();

// Delete
function deleteTodoList(todo: TodolistResponse) {
    loadingModal.show();
    HTTP.post('/todolist/delete', {
        'id': todo.id
    }).then(_ => { loadingModal.hide(); getTodolist() });
}

// Toggle
function toggleTodoList(todo: TodolistResponse) {
    loadingModal.show();
    HTTP.post('/todolist/toggle', {
        'id': todo.id
    }).then(_ => { loadingModal.hide(); getTodolist() });
}

// Add Module
const addTodolistModal = new Modal(document.querySelector('#add-todolist-modal'), { backdrop: "static", keyboard: false });
document.querySelector<HTMLButtonElement>('#add-todolist-button').addEventListener('click', function (e) {
    addTodolistModal.show();
});
document.querySelector('#add-todolist-modal').addEventListener('hide.bs.modal', e => {
    document.querySelector<HTMLInputElement>('#add-todolist-title').value = "";
    document.querySelector<HTMLTextAreaElement>('#add-todolist-content').value = "";

    document.querySelector<HTMLInputElement>('#error-add-todolist-title').textContent = "";
    document.querySelector<HTMLTextAreaElement>('#error-add-todolist-content').textContent = "";
    document.querySelector<HTMLDivElement>('#add-todolist-modal-footer').style.display = 'flex';
});
document.querySelector('#add-todolist-submit').addEventListener('click', async _ => {

    let title = document.querySelector<HTMLInputElement>('#add-todolist-title');
    let content = document.querySelector<HTMLTextAreaElement>('#add-todolist-content');

    let error_title = document.querySelector('#error-add-todolist-title');
    let error_content = document.querySelector('#error-add-todolist-content');

    let isValid = true;

    if (title.value.length <= 0) {
        isValid = false;
        error_title.textContent = "Must be filled";
    }
    else error_title.textContent = "";

    if (content.value.length <= 0) {
        isValid = false;
        error_content.textContent = "Must be filled";
    }
    else error_content.textContent = "";

    if (isValid) {
        document.querySelector<HTMLDivElement>('#add-todolist-modal-footer').style.display = 'none';
        let res = await HTTP.post('/todolist/add', {
            title: title.value,
            content: content.value
        });

        if (res.status === 200) alert("Success");
        else alert("Error");

        addTodolistModal.hide();
        document.querySelector<HTMLDivElement>('#add-todolist-modal-footer').style.display = 'flex';
        getTodolist();
    }
});

// Update Modal
const updateTodolistModal = new Modal(document.querySelector('#update-todolist-modal'), { backdrop: "static", keyboard: false });
function updateTodoList (todo: TodolistResponse) {
    updateTodolistModal.show();
    document.querySelector<HTMLInputElement>('#update-todolist-title').value = todo.title;
    document.querySelector<HTMLTextAreaElement>('#update-todolist-content').value = todo.content;
    document.querySelector('#update-todolist-submit').addEventListener('click', async _ => {

        let title = document.querySelector<HTMLInputElement>('#update-todolist-title');
        let content = document.querySelector<HTMLTextAreaElement>('#update-todolist-content');

        let error_title = document.querySelector('#error-update-todolist-title');
        let error_content = document.querySelector('#error-update-todolist-content');

        let isValid = true;

        if (title.value.length <= 0) {
            isValid = false;
            error_title.textContent = "Must be filled";
        }
        else error_title.textContent = "";

        if (content.value.length <= 0) {
            isValid = false;
            error_content.textContent = "Must be filled";
        }
        else error_content.textContent = "";

        if (isValid) {
            document.querySelector<HTMLDivElement>('#update-todolist-modal-footer').style.display = 'none';
            let res = await HTTP.post('/todolist/update', {
                title: title.value,
                content: content.value,
                id: todo.id
            });

            if (res.status === 200) alert("Success");
            else alert("Error");

            updateTodolistModal.hide();
            document.querySelector<HTMLDivElement>('#update-todolist-modal-footer').style.display = 'flex';
            getTodolist();
        }
    });

}
document.querySelector('#update-todolist-modal').addEventListener('hide.bs.modal', e => {
    document.querySelector<HTMLInputElement>('#update-todolist-title').value = "";
    document.querySelector<HTMLTextAreaElement>('#update-todolist-content').value = "";

    document.querySelector<HTMLInputElement>('#error-update-todolist-title').textContent = "";
    document.querySelector<HTMLTextAreaElement>('#error-update-todolist-content').textContent = "";
    document.querySelector<HTMLDivElement>('#update-todolist-modal-footer').style.display = 'flex';
});
