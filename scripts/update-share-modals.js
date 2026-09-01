const fs = require('fs');
const path = require('path');

const projectDir = path.join(__dirname, '..');

const shareModalHtml = `  <!-- Share Link Modal (Matching Reference Image 2) -->
  <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content share-modal-content" style="background-color: #282b36 !important; color: #ffffff !important; border-radius: 16px !important; border: 1px solid #3f4452 !important;">
        <!-- Header -->
        <div class="modal-header share-modal-header border-0 d-flex justify-content-between align-items-center" style="background-color: #282b36 !important; border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;">
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-external-link-alt text-light fs-5"></i>
            <h5 class="modal-title fw-bold text-white mb-0" id="shareModalLabel">Share link</h5>
          </div>
          <div class="d-flex align-items-center gap-2">
            <div class="contact-avatar-img" style="width: 32px; height: 32px; font-size: 0.85rem; background: #3f4452; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-user"></i>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="modal-body p-4" style="background-color: #282b36 !important; color: #ffffff !important;">
          <!-- URL Input Row -->
          <div class="share-url-box mb-4" style="background-color: #1e2029 !important; border: 1px solid #3f4452 !important; border-radius: 12px !important; padding: 10px 14px !important; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-link text-white-50 fs-5"></i>
            <input type="text" class="share-url-input" id="shareUrlInput" readonly value="" placeholder="https://brightfutureconsultancy.com/jobs.html" style="background: transparent !important; border: none !important; color: #ffffff !important; font-size: 0.9rem !important; width: 100%;">
            <button type="button" class="share-icon-btn" id="btnQrCode" title="Show QR Code" onclick="toggleQrCode()" style="background: rgba(255,255,255,0.15) !important; border: none !important; color: #fff !important; width: 36px; height: 36px; border-radius: 8px !important; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-qrcode"></i>
            </button>
            <button type="button" class="share-icon-btn" title="Copy Link" onclick="copyShareLink()" style="background: rgba(255,255,255,0.15) !important; border: none !important; color: #fff !important; width: 36px; height: 36px; border-radius: 8px !important; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-copy"></i>
            </button>
          </div>

          <!-- QR Code Container -->
          <div id="qrCodeContainer" class="text-center py-3 d-none mb-4 bg-white rounded-3 p-3">
            <img id="qrCodeImg" src="" alt="QR Code" style="max-width: 160px; height: auto;">
            <p class="text-dark small mb-0 mt-2 fw-semibold">Scan QR code to open job link</p>
          </div>

          <!-- Direct Contacts Row -->
          <div class="d-flex align-items-center gap-4 overflow-x-auto pb-3 mb-4 border-bottom border-secondary border-opacity-25">
            <div class="contact-avatar-box" onclick="shareDirectContact('Simran Shikh', 'email')" style="min-width: 80px; text-align: center; cursor: pointer;">
              <div class="contact-avatar-img mx-auto" style="width: 52px; height: 52px; border-radius: 50%; background: #3f4452; color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; position: relative;">
                SS
                <div class="contact-badge-icon bg-danger" style="position: absolute; bottom: -2px; right: -2px; width: 22px; height: 22px; border-radius: 50%; font-size: 11px; display: flex; align-items: center; justify-content: center; border: 2px solid #282b36; color: #fff;"><i class="fas fa-envelope"></i></div>
              </div>
              <small class="text-white-50 mt-2 d-block" style="font-size: 0.72rem; line-height: 1.2;">Simran Shikh<br>(You)</small>
            </div>

            <div class="contact-avatar-box" onclick="shareDirectContact('Outlook', 'outlook')" style="min-width: 80px; text-align: center; cursor: pointer;">
              <div class="contact-avatar-img mx-auto" style="width: 52px; height: 52px; border-radius: 50%; background: #3f4452; color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; position: relative;">
                O
                <div class="contact-badge-icon bg-primary" style="position: absolute; bottom: -2px; right: -2px; width: 22px; height: 22px; border-radius: 50%; font-size: 11px; display: flex; align-items: center; justify-content: center; border: 2px solid #282b36; color: #fff;"><i class="fas fa-envelope-open"></i></div>
              </div>
              <small class="text-white-50 mt-2 d-block" style="font-size: 0.72rem; line-height: 1.2;">outlook_6B9C2...<br>6F96D39ED2...</small>
            </div>

            <div class="contact-avatar-box" onclick="shareDirectContact('918597463323', 'whatsapp')" style="min-width: 80px; text-align: center; cursor: pointer;">
              <div class="contact-avatar-img mx-auto" style="width: 52px; height: 52px; border-radius: 50%; background: #3f4452; color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; position: relative;">
                <img src="assets/images/team/manirul.svg" alt="Contact" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                <div class="contact-badge-icon bg-success" style="position: absolute; bottom: -2px; right: -2px; width: 22px; height: 22px; border-radius: 50%; font-size: 11px; display: flex; align-items: center; justify-content: center; border: 2px solid #282b36; color: #fff;"><i class="fab fa-whatsapp"></i></div>
              </div>
              <small class="text-white-50 mt-2 d-block" style="font-size: 0.72rem; line-height: 1.2;">+91 85974<br>63323</small>
            </div>

            <div class="contact-avatar-box" onclick="shareDirectContact('918697629432', 'whatsapp')" style="min-width: 80px; text-align: center; cursor: pointer;">
              <div class="contact-avatar-img mx-auto" style="width: 52px; height: 52px; border-radius: 50%; background: #3f4452; color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; position: relative;">
                <i class="fas fa-user text-white-50"></i>
                <div class="contact-badge-icon bg-success" style="position: absolute; bottom: -2px; right: -2px; width: 22px; height: 22px; border-radius: 50%; font-size: 11px; display: flex; align-items: center; justify-content: center; border: 2px solid #282b36; color: #fff;"><i class="fab fa-whatsapp"></i></div>
              </div>
              <small class="text-white-50 mt-2 d-block" style="font-size: 0.72rem; line-height: 1.2;">+91 86976<br>29432</small>
            </div>

            <div class="contact-avatar-box" onclick="shareDirectContact('919332601587', 'whatsapp')" style="min-width: 80px; text-align: center; cursor: pointer;">
              <div class="contact-avatar-img mx-auto" style="width: 52px; height: 52px; border-radius: 50%; background: #3f4452; color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; position: relative;">
                <img src="assets/images/team/hafijur.svg" alt="Contact" class="w-100 h-100 rounded-circle" style="object-fit: cover;">
                <div class="contact-badge-icon bg-success" style="position: absolute; bottom: -2px; right: -2px; width: 22px; height: 22px; border-radius: 50%; font-size: 11px; display: flex; align-items: center; justify-content: center; border: 2px solid #282b36; color: #fff;"><i class="fab fa-whatsapp"></i></div>
              </div>
              <small class="text-white-50 mt-2 d-block" style="font-size: 0.72rem; line-height: 1.2;">+91 93326<br>01587</small>
            </div>
          </div>

          <!-- Share Using Platforms Grid -->
          <h6 class="fw-bold text-white mb-3" style="font-size: 0.95rem;">Share using</h6>
          
          <div class="row g-2 text-center">
            <!-- 1. Nearby Sharing -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="javascript:void(0)" class="share-platform-item" onclick="triggerNativeShare()" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-info" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fas fa-rss-square"></i>
                </div>
                <small style="font-size: 0.78rem;">Nearby Sharing</small>
              </a>
            </div>

            <!-- 2. Facebook -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareFb" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-primary" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-facebook"></i>
                </div>
                <small style="font-size: 0.78rem;">Facebook</small>
              </a>
            </div>

            <!-- 3. Gmail -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareGmail" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-danger" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fas fa-envelope"></i>
                </div>
                <small style="font-size: 0.78rem;">Gmail</small>
              </a>
            </div>

            <!-- 4. Copilot -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="javascript:void(0)" class="share-platform-item" onclick="shareCopilot()" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box" style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #00c6ff, #0072ff); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fas fa-robot"></i>
                </div>
                <small style="font-size: 0.78rem;">Copilot</small>
              </a>
            </div>

            <!-- 5. Microsoft 365 -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="javascript:void(0)" class="share-platform-item" onclick="shareCopilot()" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box" style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #0072ff, #7f00ff); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-microsoft"></i>
                </div>
                <small style="font-size: 0.78rem;">Microsoft 365</small>
              </a>
            </div>

            <!-- 6. Outlook -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareOutlook" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-primary" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fas fa-envelope-open-text"></i>
                </div>
                <small style="font-size: 0.78rem;">Outlook</small>
              </a>
            </div>

            <!-- 7. WhatsApp -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareWa" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-success" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-whatsapp"></i>
                </div>
                <small style="font-size: 0.78rem;">WhatsApp</small>
              </a>
            </div>

            <!-- 8. Twitter / X -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareTw" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-light" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-x-twitter"></i>
                </div>
                <small style="font-size: 0.78rem;">Twitter</small>
              </a>
            </div>

            <!-- 9. LinkedIn -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareLinkedin" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-info" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-linkedin"></i>
                </div>
                <small style="font-size: 0.78rem;">LinkedIn</small>
              </a>
            </div>

            <!-- 10. Telegram -->
            <div class="col-4 col-sm-3 col-md-2">
              <a href="#" id="shareTg" target="_blank" class="share-platform-item" style="color: #e2e8f0 !important; text-decoration: none !important;">
                <div class="share-platform-icon-box text-info" style="width: 48px; height: 48px; border-radius: 14px; background: #1e2029; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 6px;">
                  <i class="fab fa-telegram-plane"></i>
                </div>
                <small style="font-size: 0.78rem;">Telegram</small>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>`;

const htmlFiles = fs.readdirSync(projectDir).filter(f => f.endsWith('.html'));

htmlFiles.forEach(file => {
  const filePath = path.join(projectDir, file);
  let content = fs.readFileSync(filePath, 'utf8');

  // Replace existing share modal
  content = content.replace(/<!-- Share Link Modal [\s\S]*?<\/div>\s*<\/div>\s*<\/div>/gi, shareModalHtml);
  content = content.replace(/<div class="modal fade" id="shareModal"[\s\S]*?<\/div>\s*<\/div>\s*<\/div>/gi, shareModalHtml);

  fs.writeFileSync(filePath, content, 'utf8');
  console.log(`Updated dark share modal in ${file}`);
});
