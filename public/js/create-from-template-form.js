// * add event listeners to the button that will shows attachments input and its label
const addAttachmentButton = document.getElementById('add-attachments-button');
addAttachmentButton.addEventListener('click', toggle);

function toggle( e ) {
    e.preventDefault();
    let attachmentGroup = document.getElementById('attachment-group');
    if (attachmentGroup.style.display === 'flex') {
        attachmentGroup.style.display = 'none';
        return;
    }
    attachmentGroup.style.display = 'flex';
}