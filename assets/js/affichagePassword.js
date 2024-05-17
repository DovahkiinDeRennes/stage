document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('toggleMdp').addEventListener('change', function () {
        var mdp = document.getElementById('mdp');
        mdp.type = this.checked ? 'text' : 'password';
    });

    document.getElementById('toggleAncienMdp').addEventListener('change', function () {
        var ancienMdp = document.getElementById('ancienmdp');
        ancienMdp.type = this.checked ? 'text' : 'password';
    });

    document.getElementById('toggleNewMdp').addEventListener('change', function () {
        var newMdp = document.getElementById('newmdp');
        newMdp.type = this.checked ? 'text' : 'password';
    });

    document.getElementById('toggleConfMdp').addEventListener('change', function () {
        var confMdp = document.getElementById('confmdp');
        confMdp.type = this.checked ? 'text' : 'password';
    });
});