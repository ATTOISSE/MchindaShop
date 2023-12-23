const btn = document.getElementById('btn')

btn.addEventListener('click', () => {
    const alert = document.getElementById('alert')
    alert.removeAttribute('hidden')
    const url = btn.getAttribute('data-url')
    setTimeout(() => {
        window.location.href = url;
    }, 2000);
})