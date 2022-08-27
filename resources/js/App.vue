<template>
	<div>
		<router-view />
	</div>
</template>


<script>
import Sidebar from "./partials/Sidebar.vue";
import Topbar from "./partials/Topbar.vue";
import Footer from "./partials/Footer.vue";

export default {
	components: { Sidebar, Topbar, Footer },
	mounted() {
		let scriptTag = document.createElement("script");
		scriptTag.async = true;
		scriptTag.setAttribute("src", `/assets/js/template.js`);
		document.head.appendChild(scriptTag);
	},
};
</script>
