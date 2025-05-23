let previewContainer = document.querySelector('.equipment-preview');
let previewBox = previewContainer.querySelectorAll('.preview');

document.querySelectorAll('.equipment-container .equipment').forEach(equipment => {
  equipment.onclick = () => {
    previewContainer.style.display = 'flex';
    let name = equipment.getAttribute('data-name');
    previewBox.forEach(preview => {
      let target = preview.getAttribute('data-target');
      if (name == target) {
        preview.classList.add('active');
      }
    });
  };
});

previewBox.forEach(close => {
  close.querySelector('.fa-times').onclick = () => {
    close.classList.remove('active');
    previewContainer.style.display = 'none';
  };
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleButtons = document.querySelectorAll(".toggle-status");

  const modal = document.getElementById("reportCardModal");
  const closeModal = document.getElementById("closeModal");
  const submitReport = document.getElementById("submitReport");
  const reasonInput = document.getElementById("maintenanceReason");

  toggleButtons.forEach(button => {
    button.addEventListener("click", () => {
      const preview = button.closest(".preview");
      const previewStatusLabels = preview.querySelectorAll(".status-label");
      const target = preview.getAttribute("data-target");
      const equipment = document.querySelector(`.equipment[data-name="${target}"]`);
      const equipmentStatusLabel = equipment.querySelector(".status-label");

      let newStatus, newColor;
      const currentStatus = previewStatusLabels[0].textContent.trim();

      if (currentStatus === "Working") {
        // Trigger modal for maintenance report
        modal.style.display = "block";

        // Save context to apply changes after modal submission
        modal.dataset.preview = preview;
        modal.dataset.equipment = target;
      } else {
        newStatus = "Working";
        newColor = "green";

        previewStatusLabels.forEach(label => {
          label.textContent = newStatus;
          label.style.color = newColor;
        });

        equipmentStatusLabel.textContent = newStatus;
        equipmentStatusLabel.style.color = newColor;
      }
    });
  });

  // Modal close handlers
  closeModal.onclick = () => {
    modal.style.display = "none";
    reasonInput.value = "";
  };

  window.onclick = (event) => {
    if (event.target == modal) {
      modal.style.display = "none";
      reasonInput.value = "";
    }
  };

  // Submit report
  submitReport.onclick = () => {
    const reason = reasonInput.value.trim();
    if (!reason) {
      alert("Please describe the issue before submitting.");
      return;
    }

    // Apply status update after submission
    const preview = document.querySelector(`.preview[data-target="${modal.dataset.equipment}"]`);
    const equipment = document.querySelector(`.equipment[data-name="${modal.dataset.equipment}"]`);
    const previewStatusLabels = preview.querySelectorAll(".status-label");
    const equipmentStatusLabel = equipment.querySelector(".status-label");

    const newStatus = "Under Maintenance";
    const newColor = "red";

    previewStatusLabels.forEach(label => {
      label.textContent = newStatus;
      label.style.color = newColor;
    });

    equipmentStatusLabel.textContent = newStatus;
    equipmentStatusLabel.style.color = newColor;

    alert("Report submitted:\n" + reason);
    reasonInput.value = "";
    modal.style.display = "none";
  };
});

