/**
 * Signals — Human Interaction Signals
 * No cookies, no storage, no fingerprinting
 */

(function () {
  let start = Date.now();
  let interacted = false;

  function markInteraction() {
    interacted = true;
    window.removeEventListener('mousemove', markInteraction);
    window.removeEventListener('keydown', markInteraction);
    window.removeEventListener('scroll', markInteraction);
  }

  window.addEventListener('mousemove', markInteraction);
  window.addEventListener('keydown', markInteraction);
  window.addEventListener('scroll', markInteraction);

  window.addEventListener('beforeunload', function () {
    const duration = Math.round((Date.now() - start) / 1000);

    const payload = {
      duration: duration,
      interacted: interacted
    };

    navigator.sendBeacon(
      '/human-analytics/public/collect.php',
      JSON.stringify(payload)
    );
  });
})();
