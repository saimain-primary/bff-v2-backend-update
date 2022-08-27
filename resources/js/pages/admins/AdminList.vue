<template>
	<Layout>
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Admin Accounts</h4>
						<div v-if="isLoading">
							<div class="alert alert-primary" role="alert">
								<i data-feather="alert-circle"></i>
								Please wait while fetching the list ...
							</div>
						</div>
						<div v-else>
							<div class="table-responsive">
								<table class="table fs-6">
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Created By</th>
											<th>Created At</th>
											<th>Updated At</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="d in data" :key="d.id">
											<td>
												{{ d.name }}
											</td>
											<td>{{ d.email }}</td>
											<td>
												{{ d.created_by?.name }}
											</td>
											<td>{{ d.created_at }}</td>
											<td>{{ d.updated_at }}</td>
											<td>
												<router-link to="/">
													<vue-feather
														class="text-primary me-2"
														type="eye"
														size="18px"
														stroke-width="2"
													></vue-feather>
												</router-link>
												<router-link to="/">
													<vue-feather
														class="text-primary me-2"
														type="edit-2"
														size="18px"
														stroke-width="2"
													></vue-feather>
												</router-link>
												<router-link to="/">
													<vue-feather
														class="text-primary"
														type="trash"
														size="18px"
														stroke-width="2"
													></vue-feather>
												</router-link>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="float-start mt-4">
								Showing {{ pagination.from }} to {{ pagination.to }} of
								{{ pagination.total }} entries
							</div>
							<nav class="mt-3 float-end" aria-label="Page navigation example">
								<ul class="pagination pagination-sm mb-0">
									<li
										class="page-item"
										:class="{ disabled: pagination.current_page < 2 }"
									>
										<a
											class="page-link"
											href="javascript:;"
											@click.prevent="changePage(pagination.current_page - 1)"
										>
											Previous</a
										>
									</li>
									<li
										v-for="page in pagesNumber"
										:key="page"
										class="page-item"
										:class="[page == isActived ? 'active' : '']"
										@click.prevent="changePage(page)"
									>
										<a class="page-link" href="javascript:;">{{ page }}</a>
									</li>
									<li
										class="page-item"
										:class="{
											disabled: pagination.current_page < pagination.last_page,
										}"
									>
										<a
											class="page-link"
											href="javascript:;"
											@click.prevent="changePage(pagination.current_page + 1)"
										>
											Next
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</Layout>
</template>

<script>
import Layout from "../Layout.vue";
import { mapActions } from "vuex";

export default {
	components: { Layout },
	data() {
		return {
			isLoading: false,
			data: [],
			paginationParams: {
				page: 1,
				perPage: 10,
			},
			pagination: {},
			offset: 1,
		};
	},
	computed: {
		isActived: function () {
			return this.pagination.current_page;
		},
		pagesNumber: function () {
			console.log("to", this.pagination.to);
			if (!this.pagination.to) {
				return [];
			}
			var from = this.pagination.current_page - this.offset;
			if (from < 1) {
				from = 1;
			}
			var to = from + this.offset * 2;
			console.log("*", to);
			console.log("last", this.pagination.last_page);
			console.log("*", to);
			if (to >= this.pagination.last_page) {
				to = this.pagination.last_page;
			}
			var pagesArray = [];
			while (from <= to) {
				pagesArray.push(from);
				from++;
			}

			return pagesArray;
		},
	},
	methods: {
		...mapActions({
			getAdminListAction: "getAdminListAction",
		}),
		changePage: async function (page) {
			this.isLoading = true;
			this.pagination.current_page = page;
			this.paginationParams.page = page;
			const result = await this.getAdminListAction(this.paginationParams);
			if (result.success === true) {
				this.isLoading = false;
				this.data = result.data.results.data;
				this.pagination = {
					total: result.data.results.total,
					per_page: result.data.results.per_page,
					from: result.data.results.from,
					to: result.data.results.to,
					current_page: result.data.results.current_page,
					last_page: result.data.results.last_page,
				};
				console.log(result.data.results);
			}
		},
	},
	async mounted() {
		this.isLoading = true;
		const result = await this.getAdminListAction(this.paginationParams);
		if (result.success === true) {
			this.isLoading = false;
			this.data = result.data.results.data;
			this.pagination = {
				total: result.data.results.total,
				per_page: result.data.results.per_page,
				from: result.data.results.from,
				to: result.data.results.to,
				current_page: result.data.results.current_page,
				last_page: result.data.results.last_page,
			};
			console.log(result.data.results);
		}
	},
};
</script>
