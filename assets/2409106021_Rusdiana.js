// Script sederhana untuk efek klik tombol
document.querySelectorAll('button').forEach(btn => {
    btn.addEventListener('click', () => {
        btn.style.transform = 'scale(0.95)';
        setTimeout(() => btn.style.transform = 'scale(1)', 150);
    });
});
