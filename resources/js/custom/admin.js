// JavaScript for Admin Template functionality
document.addEventListener("DOMContentLoaded", () => {
  // Sidebar elements
  const sidebar = document.getElementById("sidebar")
  const sidebarToggle = document.getElementById("sidebarToggle")
  const sidebarOverlay = document.getElementById("sidebarOverlay")
  const mainContent = document.querySelector(".main-content")
  const footer = document.querySelector(".footer")
  const sidebarLinks = document.querySelectorAll(".sidebar-nav .nav-link")

  // Initialize sidebar state
  let sidebarCollapsed = false
  let tooltipInstances = []

  // Import Bootstrap
  const bootstrap = window.bootstrap

  // Function to toggle sidebar on desktop (collapse/expand)
  function toggleSidebarCollapse() {
    if (window.innerWidth >= 768) {
      // Desktop: only toggle collapse, never show overlay
      sidebarCollapsed = !sidebarCollapsed

      if (sidebarCollapsed) {
        sidebar.classList.add("collapsed")
        mainContent.classList.add("sidebar-collapsed")
        footer.classList.add("sidebar-collapsed")
        addTooltips()
      } else {
        sidebar.classList.remove("collapsed")
        mainContent.classList.remove("sidebar-collapsed")
        footer.classList.remove("sidebar-collapsed")
        removeTooltips()
      }

      // Ensure overlay is never shown on desktop
      sidebarOverlay.classList.remove("show")
    } else {
      // Mobile: toggle sidebar slide-in with overlay
      toggleMobileSidebar()
    }
  }

  // Function to toggle sidebar on mobile
  function toggleMobileSidebar() {
    if (window.innerWidth < 768) {
      sidebar.classList.toggle("show")
      sidebarOverlay.classList.remove("show")
    }
  }

  // Function to add tooltips to nav links
  function addTooltips() {
    sidebarLinks.forEach((link) => {
      const text = link.querySelector("span").textContent
      link.setAttribute("title", text)
      link.setAttribute("data-bs-toggle", "tooltip")
      link.setAttribute("data-bs-placement", "right")

      const tooltip = new bootstrap.Tooltip(link)
      tooltipInstances.push(tooltip)
    })
  }

  // Function to remove tooltips
  function removeTooltips() {
    tooltipInstances.forEach((tooltip) => {
      tooltip.dispose()
    })
    tooltipInstances = []

    sidebarLinks.forEach((link) => {
      link.removeAttribute("title")
      link.removeAttribute("data-bs-toggle")
      link.removeAttribute("data-bs-placement")
    })
  }

  // Toggle sidebar when clicking the toggle button
  sidebarToggle.addEventListener("click", (e) => {
    e.preventDefault()
    toggleSidebarCollapse()
  })

  // Close mobile sidebar when clicking overlay
  sidebarOverlay.addEventListener("click", () => {
    if (window.innerWidth < 768) {
      toggleMobileSidebar()
    }
  })

  // Handle sidebar link clicks
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault()

      // Remove active class from all links
      sidebarLinks.forEach((l) => l.classList.remove("active"))

      // Add active class to clicked link
      this.classList.add("active")

      // Update page title based on clicked link
      const pageTitle = document.querySelector(".page-title")
      const linkText = this.querySelector("span").textContent.trim()
      pageTitle.textContent = linkText

      // Update breadcrumb
      const breadcrumbActive = document.querySelector(".breadcrumb-item.active")
      breadcrumbActive.textContent = linkText

      // Close mobile sidebar after click
      if (window.innerWidth < 768 && sidebar.classList.contains("show")) {
        toggleMobileSidebar()
      }
    })
  })

  // Handle window resize
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 768) {
      // Desktop mode - hide mobile overlay and reset mobile sidebar
      sidebar.classList.remove("show")
      sidebarOverlay.classList.remove("show")
    } else {
      // Mobile mode - reset collapsed state
      if (sidebarCollapsed) {
        sidebar.classList.remove("collapsed")
        mainContent.classList.remove("sidebar-collapsed")
        footer.classList.remove("sidebar-collapsed")
        removeTooltips()
        sidebarCollapsed = false
      }
    }
  })

  // Initialize other functionality
  initializeOtherFeatures()
})

// Function to initialize other features
function initializeOtherFeatures() {
  // Initialize tooltips for other elements
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]:not(.nav-link)'))
  var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => new window.bootstrap.Tooltip(tooltipTriggerEl))

  // Simulate real-time data updates
  function updateStats() {
    const statsElements = document.querySelectorAll(".h5.mb-0.font-weight-bold")

    statsElements.forEach((element) => {
      const currentValue = Number.parseInt(element.textContent.replace(/[^0-9]/g, ""))
      const change = Math.floor(Math.random() * 10) - 5
      const newValue = Math.max(0, currentValue + change)

      if (element.textContent.includes("$")) {
        element.textContent = "$" + newValue.toLocaleString()
      } else {
        element.textContent = newValue.toLocaleString()
      }
    })
  }

  // Update stats every 30 seconds
  setInterval(updateStats, 30000)

  // Add loading animation to buttons
  const actionButtons = document.querySelectorAll(".card-body .btn")
  actionButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const originalText = this.innerHTML
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading...'
      this.disabled = true

      setTimeout(() => {
        this.innerHTML = originalText
        this.disabled = false
      }, 2000)
    })
  })

  // Initialize progress bar animations
  const progressBars = document.querySelectorAll(".progress-bar")
  progressBars.forEach((bar) => {
    const width = bar.style.width
    bar.style.width = "0%"
    setTimeout(() => {
      bar.style.width = width
      bar.style.transition = "width 1s ease-in-out"
    }, 500)
  })
}

// Function to show notifications
function showNotification(message, type = "info") {
  const notification = document.createElement("div")
  notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`
  notification.style.cssText = "top: 70px; right: 20px; z-index: 1050; min-width: 300px;"
  notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `

  document.body.appendChild(notification)

  setTimeout(() => {
    if (notification.parentNode) {
      notification.remove()
    }
  }, 5000)
}

// Show welcome notification
setTimeout(() => {
  showNotification("Welcome to the Admin Dashboard!", "success")
}, 1000)
