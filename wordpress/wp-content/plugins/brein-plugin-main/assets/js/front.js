// Frontend entry
import "../css/front.scss";
import kjua from 'kjua';

function initWhatsAppModal() {
  const modal = document.querySelector('[data-whatsapp-modal]');
  if (!modal) return;
  // QR-code generation
  const url = (modal.getAttribute('data-whatsapp-modal') || '').trim();
  if (!url) return;

  const config = {
    tooltipDelay: 6000,
    tooltipDuration: 5000,
  }
  const tooltip = document.querySelector('[data-whatsapp-modal-tooltip]');

  // Tooltip timing: show after delay, hide after duration
  if (tooltip) {
    tooltip.classList.remove('is-visible');
    window.setTimeout(() => {
      tooltip.classList.add('is-visible');
      window.setTimeout(() => {
        tooltip.classList.remove('is-visible');
      }, config.tooltipDuration);
    }, config.tooltipDelay);
  }

  // Generate an SVG QR via kjua
  const svg = kjua({
    text: url,
    render: 'svg',
    crisp: true,
    minVersion: 1,
    ecLevel: 'M',
    size: 540,
    fill: '#000000',
    back: '#FFFFFF',
    rounded: 0
  });

  // Let CSS control sizing
  svg.removeAttribute('width');
  svg.removeAttribute('height');
  svg.removeAttribute('style');

  // Insert into canvas (or multiple if needed)
  modal.querySelectorAll('[data-whatsapp-modal-qr-canvas]').forEach((placeholder, i) => {
    const node = i === 0 ? svg : svg.cloneNode(true);
    placeholder.appendChild(node);
  });

  // Toggle open/close the modal
  document.querySelectorAll('[data-whatsapp-modal-toggle]').forEach(btn => {
    btn.addEventListener('click', (e) => {
      if (!modal) return;
      if (tooltip.classList.contains('is-visible')) {
        tooltip.classList.remove('is-visible');
      }
      tooltip.classList.add('is-hidden');
      const isActive = modal.getAttribute('data-whatsapp-modal-status') === 'active';
      modal.setAttribute('data-whatsapp-modal-status', isActive ? 'not-active' : 'active');
    });
  });

  // Close on ESC key
  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' || event.keyCode === 27) {
      if (modal) {
        modal.setAttribute('data-whatsapp-modal-status', 'not-active');
      }
    }
  });
}

// Initialize WhatsApp Modal (Generate QR Code)
document.addEventListener('DOMContentLoaded', function() {
  initWhatsAppModal();
});