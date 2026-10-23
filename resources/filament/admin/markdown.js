(() => {
    const HEADING_TYPES = ["added", "fixed", "removed", "changed", "updated"];

    const detectType = (text) => {
        const t = (text || "").toLowerCase();
        for (const key of HEADING_TYPES) {
            if (new RegExp(`\\b${key}\\b`).test(t)) return key;
        }
        return null;
    };

    const getLang = (codeEl) => {
        const classes = (codeEl.className || "").split(/\s+/);
        for (const c of classes) {
            const m = c.match(/^(?:language|lang)-(.+)$/i);
            if (m) return m[1].toUpperCase();
        }
        const pre = codeEl.closest("pre");
        return pre?.getAttribute("data-lang")?.toUpperCase() || null;
    };

    const ensureWrappedPre = (pre) => {
        if (
            pre.parentElement &&
            pre.parentElement.classList.contains("md-code")
        ) {
            return pre.parentElement;
        }
        const wrap = document.createElement("div");
        wrap.className = "md-code";
        pre.parentElement.insertBefore(wrap, pre);
        wrap.appendChild(pre);
        return wrap;
    };

    const addCopyButton = (wrap, codeEl) => {
        if (wrap.querySelector(".md-copy")) return;
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "md-copy";
        btn.textContent = "Copy";
        btn.addEventListener("click", async () => {
            try {
                await navigator.clipboard.writeText(codeEl.innerText);
                const old = btn.textContent;
                btn.textContent = "Copied!";
                setTimeout(() => (btn.textContent = old), 1200);
            } catch {
                btn.textContent = "Failed";
                setTimeout(() => (btn.textContent = "Copy"), 1200);
            }
        });
        wrap.appendChild(btn);
    };

    const wrapTables = (root) => {
        root.querySelectorAll(":scope table").forEach((tbl) => {
            if (!tbl.parentElement.classList.contains("md-table-wrap")) {
                const wrap = document.createElement("div");
                wrap.className = "md-table-wrap";
                tbl.parentElement.insertBefore(wrap, tbl);
                wrap.appendChild(tbl);
            }
        });
    };

    const enhanceOne = (container) => {
        // Badges on headings
        container.querySelectorAll(":scope :is(h2,h3)").forEach((h) => {
            const type = detectType(h.textContent);
            if (type) h.setAttribute("data-type", type);
        });

        // Code blocks
        container.querySelectorAll(":scope pre > code").forEach((code) => {
            const pre = code.parentElement;
            const wrap = ensureWrappedPre(pre);
            const lang = getLang(code);
            if (lang) {
                wrap.setAttribute("data-lang", lang);
                pre.setAttribute("data-lang", lang);
            }
            addCopyButton(wrap, code);
        });

        // Tables
        wrapTables(container);
    };

    const enhanceAll = () => {
        const targets = [
            ...document.querySelectorAll(".js-markdown"),
            ...document.querySelectorAll("#changelog-content"), // backward-compat
        ];
        targets.forEach(enhanceOne);
    };

    // Run on load
    document.addEventListener("DOMContentLoaded", enhanceAll);

    // Observe changes for dynamic content (Livewire/Alpine/Turbo/etc.)
    const attachObserver = (el) => {
        const mo = new MutationObserver(() => enhanceOne(el));
        mo.observe(el, { childList: true, subtree: true });
    };
    document.addEventListener("DOMContentLoaded", () => {
        document
            .querySelectorAll(".js-markdown, #changelog-content")
            .forEach(attachObserver);
    });

    // Expose manual hook (optional)
    window.enhanceMarkdownBlocks = enhanceAll;
})();
