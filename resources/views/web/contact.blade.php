@extends('layouts.web')

@section('content')
    <!-- Contact Us Section -->
    <section id="contact" class="py-16 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">Contact Us</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div data-aos="fade-right">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Get In Touch</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-600 dark:text-blue-400 mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">Address</h4>
                                <p class="text-gray-600 dark:text-gray-400">123 Education Street, Siem Reap,
                                    Cambodia</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-phone text-blue-600 dark:text-blue-400 mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">Phone</h4>
                                <p class="text-gray-600 dark:text-gray-400">+855 12 345 678</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-envelope text-blue-600 dark:text-blue-400 mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">Email</h4>
                                <p class="text-gray-600 dark:text-gray-400">info@watdamnakschool.edu.kh</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-clock text-blue-600 dark:text-blue-400 mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">Office Hours</h4>
                                <p class="text-gray-600 dark:text-gray-400">Monday - Friday: 7:30 AM - 4:30 PM</p>
                                <p class="text-gray-600 dark:text-gray-400">Saturday: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-bold mb-4 text-gray-800 dark:text-white">Follow Us</h4>
                        <ul class="flex gap-2 list-none p-0 m-0">
                            <li>
                                <a href="https://www.facebook.com/watdamnakWLC"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-pink-600 text-white rounded-full hover:bg-pink-700 transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-700 text-white rounded-full hover:bg-blue-800 transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div data-aos="fade-left">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Send Us a Message</h3>
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Full
                                Name</label>
                            <input type="text" id="name"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email
                                Address</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                        </div>

                        <div>
                            <label for="subject" class="block text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                            <input type="text" id="subject"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white">
                        </div>

                        <div>
                            <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">Message</label>
                            <textarea id="message" rows="5"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"></textarea>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 w-full">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script></script>
@endpush
