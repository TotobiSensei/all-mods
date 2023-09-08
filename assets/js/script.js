
//ІНІЦІАЛІЗАЦІЯ КАРУСЕЛІ НА ГЛАВНІЙ!
document.addEventListener('DOMContentLoaded', function () {
  var elem = document.querySelector('.main-carousel');
  var flkty = new Flickity(elem, {
    cellAlign: 'center',
    contain: true,
    wrapAround: true // Включаем бесконечную прокрутку
  });
});

// Функция для открытия модального окна
function openModal(targetId) {
  const modal = document.getElementById(targetId);
  if (modal) {
    modal.style.display = "block";
  }
}

// Функция для закрытия модального окна
function closeModal(targetId) {
  const modal = document.getElementById(targetId);
  if (modal) {
    modal.style.display = "none";
  }
}

// Привязываем открытие и закрытие к соответствующим элементам
const openModalBtns = document.querySelectorAll(".report-button");
const closeBtns = document.querySelectorAll(".close-btn");

openModalBtns.forEach(function (openModalBtn) {
  openModalBtn.addEventListener("click", function () {
    const targetId = openModalBtn.getAttribute("data-target");
    openModal(targetId);
  });
});

closeBtns.forEach(function (closeBtn) {
  closeBtn.addEventListener("click", function () {
    const targetId = closeBtn.getAttribute("data-target");
    closeModal(targetId);
  });
});

// Предотвращение взаимодействия пользователя с контентом за пределами окна
const modals = document.querySelectorAll(".popup-block");
modals.forEach(function (modal) {
  modal.addEventListener("click", function (event) {
    if (event.target === modal) {
      const targetId = modal.getAttribute("id");
      closeModal(targetId);
    }
  });
});