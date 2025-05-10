import './bootstrap';
document.addEventListener('DOMContentLoaded', function(){
    window.livewire.on('testEvent', data => {
        console.log('livewire is Wooorking', data);
    })
});
