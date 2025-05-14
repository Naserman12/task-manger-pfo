<audio id="notifySound" src="/sounds/notification.mp3" preload="auto"></audio>

<script>
    function playNotificationSound() {
        const sound = document.getElementById("notifySound");
        if (sound) {
            sound.play().catch(e => {
                console.warn("تعذر تشغيل الصوت تلقائيًا، قد يحتاج المستخدم للتفاعل أولاً.");
            });
        }
    }

    // مثال: تشغيل الصوت عندما يُضاف إشعار جديد
    function addNotification(message) {
        // أضف الإشعار (تستخدم Alpine أو أي إطار آخر)
        // ...
        playNotificationSound(); // شغّل الصوت
    }
</script>
