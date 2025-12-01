if (document.getElementById('loginForm')) {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    emailInput.addEventListener('blur', function() {
        const email = this.value.trim();
        const errorElement = document.getElementById('email-error'); 
        
        if (!email) {
            errorElement.textContent = 'E-mail é obrigatório';
            return;
        }
        
        if (!isValidEmail(email)) {
            errorElement.textContent = 'Digite um e-mail válido';
            return;
        }
        
        errorElement.textContent = '';
    });
    
    passwordInput.addEventListener('blur', function() {
        const password = this.value;
        const errorElement = document.getElementById('password-error');
        
        if (!password) {
            errorElement.textContent = 'Senha é obrigatória';
            return;
        }
        
        if (password.length < 6) {
            errorElement.textContent = 'A senha deve ter no mínimo 6 caracteres';
            return;
        }
        
        errorElement.textContent = '';
    });
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        let isValid = true;

        if (!email) {
            document.getElementById('email-error').textContent = 'E-mail é obrigatório';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('email-error').textContent = 'Digite um e-mail válido';
            isValid = false;
        }

        if (!password) {
            document.getElementById('password-error').textContent = 'Senha é obrigatória';
            isValid = false;
        } else if (password.length < 6) {
            document.getElementById('password-error').textContent = 'A senha deve ter no mínimo 6 caracteres';
            isValid = false;
        }
        
        if (isValid) {
            alert('Login realizado com sucesso! Redirecionando...');
            window.location.href = 'cadastro.html';
        }
    });
}

if (document.getElementById('registerForm')) {
    const registerForm = document.getElementById('registerForm');
    const senhaInput = document.getElementById('senha');
    const confirmarSenhaInput = document.getElementById('confirmar-senha');
    const telefoneInput = document.getElementById('telefone');
    
    // Metodo para formatação de telefone, sempre tentando tirar tudo da mão do usuário kkkkkkk 
    telefoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        
        if (value.length > 0) {
            if (value.length <= 2) {
                value = '(' + value;
            } else if (value.length <= 7) {
                value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
            } else {
                value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7, 11);
            }
        }
        
        e.target.value = value;
    });

    confirmarSenhaInput.addEventListener('input', function() {
        const senha = senhaInput.value;
        const confirmarSenha = this.value;
        const errorElement = document.getElementById('confirmar-senha-error');
        
        if (senha !== confirmarSenha) {
            errorElement.textContent = 'As senhas não coincidem';
        } else {
            errorElement.textContent = '';
        }
    });

    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const errors = {};

        const fields = [
            'nome', 'matricula', 'email', 'telefone', 'senha', 'confirmar-senha', 'curso', 'termos'
        ];

        fields.forEach(field => {
            const element = document.getElementById(field);
            const errorElement = document.getElementById(field + '-error');
            
            if (field === 'termos') {
                if (!element.checked) {
                    errorElement.textContent = 'Você deve aceitar os termos';
                    isValid = false;
                } else {
                    errorElement.textContent = '';
                }
                return;
            }
            
            if (!element.value.trim()) {
                errorElement.textContent = 'Este campo é obrigatório';
                isValid = false;
            } else {
                errorElement.textContent = '';
            }
        });
        
        const email = document.getElementById('email').value;
        if (email && !isValidEmail(email)) {
            document.getElementById('email-error').textContent = 'Digite um e-mail válido';
            isValid = false;
        }
        
        const senha = document.getElementById('senha').value;
        if (senha && senha.length < 8) {
            document.getElementById('senha-error').textContent = 'A senha deve ter no mínimo 8 caracteres';
            isValid = false;
        }

        const confirmarSenha = document.getElementById('confirmar-senha').value;
        if (senha !== confirmarSenha) {
            document.getElementById('confirmar-senha-error').textContent = 'As senhas não coincidem';
            isValid = false;
        }
        
        const nome = document.getElementById('nome').value;
        if (nome && nome.length < 3) {
            document.getElementById('nome-error').textContent = 'O nome deve ter no mínimo 3 caracteres';
            isValid = false;
        }
        
        if (isValid) {
            document.getElementById('successModal').style.display = 'flex';
        }
    });
}

// Função para validar email, inspirado em: https://mailtrap-io.translate.goog/blog/javascript-email-validation/?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt&_x_tr_pto=tc
function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function closeModal() {
    document.getElementById('successModal').style.display = 'none';
    window.location.href = 'login.html';
}

window.addEventListener('click', function(e) {
    const modal = document.getElementById('successModal');
    if (e.target === modal) {
        closeModal();
    }
});